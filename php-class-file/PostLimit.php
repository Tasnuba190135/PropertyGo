<?php
include_once 'DbConnector.php'; // Ensure database connection is included

class PostLimit
{
    public $conn;

    // Class properties with default values.
    public $post_limit_id = 0;
    public $status = 0;
    public $user_id = 0;
    public $note_ids = "";
    public $limit = 0;
    public $created = "";
    public $updated = "";

    /**
     * Constructor: Initializes the database connection.
     */
    public function __construct()
    {
        $this->ensureConnection();
    }

    /**
     * Ensures that a database connection is established.
     */
    public function ensureConnection()
    {
        if (!$this->conn) {
            $db = new DbConnector();
            $db->connect();
            $this->conn = $db->getConnection();
        }
    }

    /**
     * Create minimal tbl_post_limit with only post_limit_id column.
     */
    public function createTableMinimal()
    {
        $this->ensureConnection();
        $sql = "CREATE TABLE IF NOT EXISTS tbl_post_limit (
                    post_limit_id INT AUTO_INCREMENT PRIMARY KEY
                ) ENGINE=InnoDB";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            echo "Minimal table 'tbl_post_limit' created successfully.<br>";
        } else {
            echo "Error creating minimal table: " . mysqli_error($this->conn) . "<br>";
        }
    }

    /**
     * Alter table tbl_post_limit to add additional columns.
     */
    public function alterTableAddColumns()
    {
        $this->ensureConnection();
        $table = "tbl_post_limit";
        $alterQueries = [
            1 => ['status',       "ALTER TABLE $table ADD COLUMN status INT DEFAULT 0"],
            2 => ['user_id',      "ALTER TABLE $table ADD COLUMN user_id INT"],
            3 => ['note_ids',     "ALTER TABLE $table ADD COLUMN note_ids TEXT"],
            4 => ['limit',        "ALTER TABLE $table ADD COLUMN `limit` INT"],
            5 => ['created',      "ALTER TABLE $table ADD COLUMN created TIMESTAMP DEFAULT CURRENT_TIMESTAMP"],
            6 => ['updated',      "ALTER TABLE $table ADD COLUMN updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"]
        ];

        foreach ($alterQueries as $num => $queryInfo) {
            list($colName, $sql) = $queryInfo;
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                echo "Column '$colName' added successfully.<br>";
            } else {
                echo "Error adding column '$colName': " . mysqli_error($this->conn) . "<br>";
            }
        }
    }

    /**
     * Insert a new post limit record.
     * @return int|false Returns the inserted post_limit_id on success, or false on failure.
     */
    public function insert()
    {
        $this->ensureConnection();
        $sql = "INSERT INTO tbl_post_limit (status, user_id, note_ids, `limit`)
                VALUES ($this->status, $this->user_id, '$this->note_ids', $this->limit)";

        if (mysqli_query($this->conn, $sql)) {
            $this->post_limit_id = mysqli_insert_id($this->conn);
            return $this->post_limit_id;
        } else {
            echo "Insert failed: " . mysqli_error($this->conn) . "<br>";
            return false;
        }
    }

    /**
     * Update an existing post limit record.
     * @return bool|string Returns true if update is successful, or an error message on failure.
     */
    public function update()
    {
        if ($this->post_limit_id == 0) {
            return "Post limit ID is not set. Cannot update.";
        }
        $sql = "UPDATE tbl_post_limit SET
                    status = $this->status,
                    user_id = $this->user_id,
                    note_ids = '$this->note_ids',
                    `limit` = $this->limit
                WHERE post_limit_id = $this->post_limit_id";

        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            echo "Post limit record updated successfully.<br>";
        } else {
            echo "Error updating record: " . mysqli_error($this->conn);
        }
        return $result;
    }

    /**
     * Set values of post limit based on user_id and status.
     * If exactly one row is found, sets the class properties accordingly.
     * @param int|null $user_id Specific user_id to load (optional).
     * @param int|null $status Status filter (optional).
     * @return array|false Returns array of results, false if no match.
     */
    public function setValueByUserId($user_id = null, $status = null)
    {
        $sql = "SELECT * FROM tbl_post_limit WHERE 1";

        if ($user_id !== null) {
            $sql .= " AND user_id = $user_id";
        }
        if ($status !== null) {
            $sql .= " AND status = $status";
        }

        $result = mysqli_query($this->conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }

            if (count($data) === 1) {
                $this->setProperties($data[0]); // Set properties if only one row is found
            }

            return $data;
        }
        return false;
    }

    /**
     * Set class properties based on an associative array of values.
     * @param array $data Associative array with column values.
     */
    private function setProperties($data)
    {
        $this->post_limit_id = $data['post_limit_id'];
        $this->status = $data['status'];
        $this->user_id = $data['user_id'];
        $this->note_ids = $data['note_ids'];
        $this->limit = $data['limit'];
        $this->created = $data['created'];
        $this->updated = $data['updated'];
    }
}
?>
