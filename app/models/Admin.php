<?php
namespace App\Models;

use App\Core\Model;
use PDO;
use PDOException;
use Exception;

class Admin extends Model {
    public function all() {
        $stmt = $this->getConnection()->query("SELECT * FROM admins");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->getConnection()->prepare("SELECT * FROM admins WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($data) {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $stmt = $this->getConnection()->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
        $stmt->execute([
            ':username' => $data['username'],
            ':password' => $hashedPassword
        ]);
        return $stmt;
    }

    public function update($id, $data) {
        $sql = "UPDATE admins SET username = :username";
        $params = [':username' => $data['username'], ':id' => $id];
        
        if (isset($data['password'])) {
            $sql .= ", password = :password";
            $params[':password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    public function delete($id) {
        $stmt = $this->getConnection()->prepare("DELETE FROM admins WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }

    public function usernameExists($username) {
        $stmt = $this->getConnection()->prepare("SELECT COUNT(*) FROM admins WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
    
    public function login($username, $password) {
        $stmt = $this->getConnection()->prepare("SELECT * FROM admins WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }
        return false;
    }
    public function updateStatus($id, $status)
    {
        $allowedStatuses = ['approved', 'rejected', 'pending'];
        if (!in_array($status, $allowedStatuses)) {
            throw new Exception('Invalid status value');
        }

        try {
            $this->db->beginTransaction();

            // First get the member's data
            $sql = "SELECT ic_no FROM pendingregistermember WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            $memberData = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$memberData) {
                throw new Exception('Member data not found');
            }

            // Update the member status
            $sql = "UPDATE pendingregistermember SET status = :status WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':status' => $status, ':id' => $id]);

            // If status is approved, create saving account if it doesn't exist
            if ($status === 'approved') {
                // Create saving account if it doesn't exist
                $sql = "INSERT IGNORE INTO saving_accounts (
                    user_ic,
                    balance,
                    created_at,
                    updated_at
                ) VALUES (
                    :user_ic,
                    0,
                    NOW(),
                    NOW()
                )";

                $stmt = $this->db->prepare($sql);
                $stmt->execute([':user_ic' => $memberData['ic_no']]);
            }

            $this->db->commit();
            return true;

        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Database Error in updateStatus: " . $e->getMessage());
            throw new Exception($e->getMessage());
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Error in updateStatus: " . $e->getMessage());
            throw new Exception($e->getMessage());
        }
    }

    public function getUserById($id)
    {
        try {
            $sql = "SELECT * FROM pendingregistermember WHERE id = :id";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            throw new Exception('Failed to fetch user details');
        }
    }
    
    public function getLoansByUserId($id)
    {
        try {
            $sql = "SELECT * FROM loan_applications WHERE id = :id";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            throw new Exception('Failed to fetch user details');
        }
    }
    
    public function getTransferRequests()
    {
        try {
            $sql = "SELECT st.*, sa.account_number, m.name as member_name, m.ic_no 
                    FROM saving_transactions st
                    JOIN saving_accounts sa ON st.account_id = sa.id
                    JOIN pendingregistermember m ON sa.user_ic = m.ic_no
                    WHERE st.transaction_type = 'transfer' 
                    ORDER BY st.transaction_date DESC";
            
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log("Error fetching transfer requests: " . $e->getMessage());
            throw new \Exception("Error fetching transfer requests: " . $e->getMessage());
        }
    }

    public function processTransferRequest($transactionId, $status, $adminRemark, $adminId)
    {
        try {
            $this->db->beginTransaction();

            // Get transaction details
            $sql = "SELECT st.*, sa.balance 
                    FROM saving_transactions st
                    JOIN saving_accounts sa ON st.account_id = sa.id
                    WHERE st.id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$transactionId]);
            $transaction = $stmt->fetch(\PDO::FETCH_ASSOC);

            if (!$transaction) {
                throw new \Exception("Transaction not found");
            }

            // Check sufficient balance for approvals
            if ($status === 'approved' && $transaction['balance'] < $transaction['amount']) {
                throw new \Exception("Insufficient balance");
            }

            // Update transaction status
            $sql = "UPDATE saving_transactions 
                   SET status = ?, 
                       admin_remark = ?,
                       processed_by = ?,
                       processed_at = NOW()
                   WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$status, $adminRemark, $adminId, $transactionId]);

            // If approved, update account balance
            if ($status === 'approved') {
                $sql = "UPDATE saving_accounts 
                       SET balance = balance - ?,
                           updated_at = NOW()
                       WHERE id = ?";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([$transaction['amount'], $transaction['account_id']]);
            }

            $this->db->commit();
            return true;
        } catch (\PDOException $e) {
            $this->db->rollBack();
            error_log("Error processing transfer request: " . $e->getMessage());
            throw new \Exception("Error processing transfer request: " . $e->getMessage());
        }
    }

    public function getAllInquiries() {
        try {
            $stmt = $this->getConnection()->prepare('
                SELECT i.*, m.full_name as member_name 
                FROM inquiries i 
                LEFT JOIN member_profile m ON i.user_id = m.user_id 
                ORDER BY i.created_at DESC
            ');
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error getting inquiries: " . $e->getMessage());
            return false;
        }
    }

    public function replyInquiry($data) {
        try {
            // Map the form values to database values
            $statusMap = [
                'in_progress' => 'in_progress',
                'completed' => 'resolved'  // Changed to match database enum
            ];

            // Validate status
            if (!isset($statusMap[$data['status']])) {
                error_log("Invalid status value: " . $data['status']);
                return false;
            }

            $stmt = $this->getConnection()->prepare('
                UPDATE inquiries 
                SET status = :status, 
                    admin_response = :admin_response, 
                    admin_id = :admin_id,
                    updated_at = NOW() 
                WHERE id = :inquiry_id
            ');
            
            $params = [
                ':inquiry_id' => $data['inquiry_id'],
                ':status' => $statusMap[$data['status']],
                ':admin_response' => $data['admin_response'],
                ':admin_id' => $data['admin_id']
            ];
            
            // Debug information
            error_log("Updating inquiry with params: " . print_r($params, true));
            
            $result = $stmt->execute($params);
            
            if (!$result) {
                error_log("Database error: " . print_r($stmt->errorInfo(), true));
                return false;
            }
            
            // Check if any rows were affected
            if ($stmt->rowCount() === 0) {
                error_log("No rows were updated for inquiry_id: " . $data['inquiry_id']);
                return false;
            }
            
            return true;
            
        } catch (PDOException $e) {
            error_log("PDO Error updating inquiry: " . $e->getMessage());
            return false;
        } catch (Exception $e) {
            error_log("General Error updating inquiry: " . $e->getMessage());
            return false;
        }
    }

    public function getMemberById($id)
    {
        try {
            // First get the member's data
            $sql = "SELECT * FROM pendingregistermember WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            $member = $stmt->fetch(PDO::FETCH_OBJ);

            if (!$member) {
                return null;
            }

            // Debug log to check member data
            error_log("Member IC: " . $member->ic_no);

            // Then get the family members using member's IC
            $familySql = "SELECT id, name, ic_no, relationship 
                         FROM member_family 
                         WHERE member_ic = :member_ic
                         ORDER BY id ASC";
            $familyStmt = $this->db->prepare($familySql);
            $familyStmt->execute([':member_ic' => $member->ic_no]);
            $familyMembers = $familyStmt->fetchAll(PDO::FETCH_OBJ);

            // Debug log to check family members
            error_log("Family members found: " . count($familyMembers));

            // Add family members to member data
            $member->family_members = $familyMembers;
            
            return $member;

        } catch (PDOException $e) {
            error_log("Error in getMemberById: " . $e->getMessage());
            throw new Exception("Error fetching member: " . $e->getMessage());
        }
    }

}