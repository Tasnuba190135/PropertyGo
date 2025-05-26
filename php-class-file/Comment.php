<?php
include_once 'DbConnector.php';

class Comment
{
    public $conn;
    public $db;
    public $table;

    public $comment_id  = 0;
    public $property_id = 0;
    public $status      = 0;
    public $user_id     = 0;
    public $comment     = '';
    public $created     = '';
    public $updated     = '';

    /**
     * Constructor.
     *
     * @param string|null $tableName Optional table name override.
     */
    public function __construct($tableName = null)
    {
        $this->ensureConnection();
        $this->table = $tableName ?? 'tbl_comment';
    }

    /**
     * Ensure a database connection is established.
     *
     * @return void
     */
    public function ensureConnection()
    {
        if (!$this->conn) {
            $this->db = new DbConnector();
            $this->db->connect();
            $this->conn = $this->db->getConnection();
        }
    }

    /**
     * Disconnect from the database.
     *
     * @return void
     */
    public function disconnect()
    {
        if ($this->db) {
            $this->db->disconnect();
        }
        $this->conn = null;
    }

    /**
     * Create a minimal version of the comments table (only primary key).
     *
     * @return void
     */
    public function createTableMinimal()
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
            comment_id INT AUTO_INCREMENT PRIMARY KEY
        ) ENGINE=InnoDB";
        mysqli_query($this->conn, $sql);
    }

    /**
     * Add all missing columns to the comments table.
     *
     * @return void
     */
    public function alterTableAddColumns()
    {
        $columns = [
            'property_id' => "ALTER TABLE {$this->table} ADD COLUMN property_id INT DEFAULT 0",
            'status'      => "ALTER TABLE {$this->table} ADD COLUMN status INT DEFAULT 0",
            'user_id'     => "ALTER TABLE {$this->table} ADD COLUMN user_id INT DEFAULT 0",
            'comment'     => "ALTER TABLE {$this->table} ADD COLUMN comment TEXT",
            'created'     => "ALTER TABLE {$this->table} ADD COLUMN created TIMESTAMP DEFAULT CURRENT_TIMESTAMP",
            'updated'     => "ALTER TABLE {$this->table} ADD COLUMN updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP",
        ];
        foreach ($columns as $col => $sql) {
            if (mysqli_query($this->conn, $sql)) {
                echo "✅ Column '{$col}' added successfully.<br>";
            } else {
                echo "ℹ️ Column '{$col}' might already exist or error: " . mysqli_error($this->conn) . "<br>";
            }
        }
    }

    /**
     * Escape a value for safe use in SQL.
     *
     * @param string $value
     * @return string
     */
    private function filter($value)
    {
        return mysqli_real_escape_string($this->conn, $value);
    }

    /**
     * Insert a new comment record.
     *
     * @return int The new comment_id, or 0 on failure.
     */
    public function insert()
    {
        $sql = "INSERT INTO {$this->table} (
            property_id, status, user_id, comment
        ) VALUES (
            " . (int)$this->property_id . ",
            " . (int)$this->status . ",
            " . (int)$this->user_id . ",
            '" . $this->filter($this->comment) . "'
        )";

        if (mysqli_query($this->conn, $sql)) {
            $this->comment_id = mysqli_insert_id($this->conn);
            return $this->comment_id;
        }
        return 0;
    }

    /**
     * Update an existing comment record.
     *
     * @return bool True on success, false on failure.
     */
    public function update()
    {
        $sql = "UPDATE {$this->table} SET
            property_id = " . (int)$this->property_id . ",
            status      = " . (int)$this->status . ",
            user_id     = " . (int)$this->user_id . ",
            comment     = '" . $this->filter($this->comment) . "'
          WHERE comment_id = " . (int)$this->comment_id;

        return (bool) mysqli_query($this->conn, $sql);
    }

    /**
     * Update only the status of an existing comment.
     *
     * @param int $status
     * @return bool True on success, false on failure.
     */
    public function updateStatus($status)
    {
        $sql = "UPDATE {$this->table} SET status = " . (int)$status .
            " WHERE comment_id = " . (int)$this->comment_id;
        return (bool) mysqli_query($this->conn, $sql);
    }

    /**
     * Set object properties from a database row.
     *
     * @param array $row Associative array of column => value.
     * @return void
     */
    public function setProperties(array $row)
    {
        foreach ($row as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Retrieve comments by any combination of filters.
     * Each parameter may be a scalar or an array of values.
     *
     * @param int|array|null    $comment_id
     * @param int|array|null    $property_id
     * @param int|array|null    $status
     * @param int|array|null    $user_id
     * @param string|array|null $comment    (ignored here)
     * @param string|array|null $created
     * @param string|array|null $updated
     * @return array Array of matching rows; empty array if none.
     */
    public function getCommentsByFilters(
        $comment_id  = null,
        $property_id = null,
        $status      = null,
        $user_id     = null,
        $comment     = null,
        $created     = null,
        $updated     = null
    ) {
        $sql = "SELECT * FROM {$this->table} WHERE 1";
        $filters = [
            'comment_id'  => $comment_id,
            'property_id' => $property_id,
            'status'      => $status,
            'user_id'     => $user_id,
            'created'     => $created,
            'updated'     => $updated,
        ];

        foreach ($filters as $col => $val) {
            if ($val !== null) {
                if (is_array($val)) {
                    $safe = implode(',', array_map('intval', $val));
                    $sql .= " AND {$col} IN ({$safe})";
                } else {
                    $safe = in_array($col, ['created', 'updated'])
                        ? "'" . $this->filter($val) . "'"
                        : (int)$val;
                    $sql .= " AND {$col} = {$safe}";
                }
            }
        }

        $res = mysqli_query($this->conn, $sql);
        if (!$res || mysqli_num_rows($res) === 0) {
            return [];
        }

        $rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
        if (count($rows) === 1) {
            $this->setProperties($rows[0]);
        }
        return $rows;
    }
}

?>

<!-- endof file -->