<?php
include_once 'DbConnector.php'; // Ensure database connection is included

class UserDetails
{
    public $conn;

    // Class properties with default values
    public $user_details_id = 0;
    public $status = 0;
    public $user_id = 0;
    public $note_ids = "";
    public $full_name = "";
    public $contact_no = "";
    public $division = "";
    public $district = "";
    public $address = "";
    public $gender = "";
    public $nid_number = "";
    public $profile_picture_id = 0;
    public $nid_file_id = 0;
    public $other_document_file_id = 0;
    public $created = "";
    public $updated = "";

    // Create a district map using ArrayObject
    public array $district_array;

    /**
     * Constructor: Initializes the database connection.
     */
    public function __construct()
    {
        $this->createDistrictMap();//Mandatory to create district map
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
        else{
            return 0;
        }
    }

    /**
     * Create minimal tbl_user_details with only the user_details_id column if it does not exist.
     *
     * @return void
     */
    public function createTableMinimal()
    {
        $this->ensureConnection();
        $sql = "CREATE TABLE IF NOT EXISTS tbl_user_details (
                    user_details_id INT AUTO_INCREMENT PRIMARY KEY
                ) ENGINE=InnoDB";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            echo "Minimal table 'tbl_user_details' created successfully.<br>";
        } else {
            echo "Error creating minimal table 'tbl_user_details': " . mysqli_error($this->conn) . "<br>";
        }
    }

    /**
     * Alter table tbl_user_details to add additional columns.
     *
     * Each query is defined as a map entry where the key is a number and the value is an array:
     * [column name, SQL query].
     * @param array|null $selectedNums Optional array of numbers. If provided, only the queries with these keys will run.
     * @return void
     */
    public function alterTableAddColumns($selectedNums =null)
    {
        $this->ensureConnection();

        $table = "tbl_user_details";

        // Define queries as a map: key => [column name, SQL query]
        $alterQueries = [
            1  => ['status',                  "ALTER TABLE $table ADD COLUMN status INT DEFAULT 0"],
            2  => ['user_id',                 "ALTER TABLE $table ADD COLUMN user_id INT"],
            3 => ['note_ids',                 "ALTER TABLE $table ADD COLUMN note_ids TEXT"],
            4  => ['full_name',               "ALTER TABLE $table ADD COLUMN full_name TEXT"],
            5  => ['contact_no',              "ALTER TABLE $table ADD COLUMN contact_no TEXT"],
            6  => ['division',                "ALTER TABLE $table ADD COLUMN division TEXT"],
            7  => ['district',                "ALTER TABLE $table ADD COLUMN district TEXT"],
            8  => ['address',                 "ALTER TABLE $table ADD COLUMN address TEXT"],
            9  => ['gender',                  "ALTER TABLE $table ADD COLUMN gender TEXT"],
            10  => ['nid_number',              "ALTER TABLE $table ADD COLUMN nid_number TEXT"],
            11 => ['profile_picture_id',      "ALTER TABLE $table ADD COLUMN profile_picture_id INT DEFAULT 0"],
            12 => ['nid_file_id',             "ALTER TABLE $table ADD COLUMN nid_file_id INT DEFAULT 0"],
            13 => ['other_document_file_id',  "ALTER TABLE $table ADD COLUMN other_document_file_id INT DEFAULT 0"],
            14 => ['created',                 "ALTER TABLE $table ADD COLUMN created TIMESTAMP DEFAULT CURRENT_TIMESTAMP"],
            15 => ['updated',                 "ALTER TABLE $table ADD COLUMN updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"]
        ];

        // If a subset of queries is provided, filter the map.
    if ($selectedNums !== null && is_array($selectedNums)) {
        $filteredQueries = [];
        foreach ($selectedNums as $num) {
            if (isset($alterQueries[$num])) {
                $filteredQueries[$num] = $alterQueries[$num];
            }
        }
        $alterQueries = $filteredQueries;
    }

        // Execute each query.
        foreach ($alterQueries as $num => $queryInfo) {
            list($colName, $sql) = $queryInfo;
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                echo "Column '$colName' added successfully to table '$table' (Key: $num).<br>";
            } else {
                echo "Error adding column '$colName' to table '$table' (Key: $num): " . mysqli_error($this->conn) . "<br>";
            }
        }
    }
    /**
     * Create a map of districts.
     *
     * @return void
     */
    public function createDistrictMap(){
        $this->district_array = [
            'Khulna' => 12,
            'Dhaka' => 13,
            'Rajshahi' => 14,
            'Chittagong' => 15,
        ];
    }


    /**
     * Insert a new user details record.
     * The 'created' and 'updated' columns are auto-generated by the database.
     *
     * @return int|false Returns inserted user_details_id or false on failure.
     */
    public function insert()
    {
        $sql = "INSERT INTO tbl_user_details (status, user_id, note_ids, full_name, contact_no, district, division, address, gender, nid_number, profile_picture_id, nid_file_id, other_document_file_id)
                VALUES (
                    $this->status,
                    $this->user_id,
                    '$this->note_ids',
                    '$this->full_name',
                    '$this->contact_no',
                    '$this->district',
                    '$this->division',
                    '$this->address',
                    '$this->gender',
                    '$this->nid_number',
                    $this->profile_picture_id,
                    $this->nid_file_id,
                    $this->other_document_file_id
                )";
               
        if (mysqli_query($this->conn, $sql)) {
            $this->user_details_id = mysqli_insert_id($this->conn);
            return $this->user_details_id;
        } else {
            echo "Insert failed: " . mysqli_error($this->conn) . "<br>";
            return false;
        }
    }

    /**
     * Update user details record based on user_details_id.
     *
     * @return bool Returns true if update is successful, false otherwise.
     */
    public function update()
    {
        if ($this->user_details_id == 0) return false; // Ensure user_details_id is set

        $sql = "UPDATE tbl_user_details SET
                    status = '$this->status',
                    user_id = $this->user_id,
                    note_ids = '$this->note_ids',
                    full_name = '$this->full_name',
                    contact_no = '$this->contact_no',
                    district = '$this->district',
                    division = '$this->division',
                    address = '$this->address',
                    gender = '$this->gender',
                    nid_number = '$this->nid_number',
                    profile_picture_id = $this->profile_picture_id,
                    nid_file_id = $this->nid_file_id,
                    other_document_file_id = $this->other_document_file_id
                WHERE user_details_id = $this->user_details_id";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            // echo "User details record updated successfully.<br>";
        } else {
            echo "Update failed: " . mysqli_error($this->conn) . "<br>";
        }
        return $result;
    }
        /**
/**
     * setValue of user details based on user_id and status.
     * If exactly one row is found, sets the class properties accordingly.
     *
     * @param int|null $user_id Specific user_id to load (optional).
     * @param int|null $status  Status filter (optional).
     * @return array|false Returns array of results, false if no match.
     */
    public function setValueByUserId($user_id = null, $status = null)
    {
        $sql = "SELECT * FROM tbl_user_details WHERE 1";
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
                $this->setProperties($data[0]); // Set properties if only one row found
            }
            return $data;
        }
        return false;
    }
        /**
     * Get distinct rows based on user_id and status.
     * @param int|null $status (Optional) Status filter
     * @return array|false Returns an array of distinct rows based on user_id, false if no match
     */
    // public function getDistinctUsersByStatus($status = null)
    // {
    //     $sql = "SELECT * FROM tbl_user_details WHERE 1";

    //     if ($status !== null) {
    //         $sql .= " AND status = $status";
    //     }

    //     $sql .= " GROUP BY user_id"; // Ensure distinct user_id

    //     $result = mysqli_query($this->conn, $sql);

    //     if ($result && mysqli_num_rows($result) > 0) {
    //         $users = [];
    //         while ($row = mysqli_fetch_assoc($result)) {
    //             $users[] = $row;
    //         }

    //         if (count($users) === 1) {
    //             $this->setProperties($users[0]); // Set properties if only one row found
    //         }

    //         return $users;
    //     }

    //     return false;
    // }


    /**
     * Set class properties based on an associative array.
     *
     * @param array $row The row data to set.
     */
    public function setProperties($row)
    {
        $this->user_details_id = $row['user_details_id'];
        $this->status = $row['status'];
        $this->user_id = $row['user_id'];
        $this->note_ids = $row['note_ids'];
        $this->full_name = $row['full_name'];
        $this->contact_no = $row['contact_no'];
        $this->district = $row['district'];
        $this->division = $row['division'];
        $this->address = $row['address'];
        $this->gender = $row['gender'];
        $this->nid_number = $row['nid_number'];
        $this->profile_picture_id = $row['profile_picture_id'];
        $this->nid_file_id = $row['nid_file_id'];
        $this->other_document_file_id = $row['other_document_file_id'];
        $this->created = $row['created'];
        $this->updated = $row['updated'];
    }

    /**
     * (Optional) Additional methods can be added here for further operations,
     * such as loading by other parameters, checking existence, or joining with other tables.
     */
        /**
     * Get user IDs from tbl_user with a given status that have a corresponding row in tbl_user_details with a given status.
     *
     */
    // public function cutsomGetUsersByStatus($userStatus, $detailsStatus, $userType = 'client')
    // {
    //     // Ensure that the database connection is active
    //     $this->ensureConnection();

    //     // Build the SQL query dynamically using the provided statuses
    //     $sql = "SELECT d.* 
    //         FROM tbl_user u
    //         JOIN tbl_user_details d ON u.user_id = d.user_id
    //         WHERE u.status = $userStatus
    //           AND d.status = $detailsStatus
    //           AND u.user_type = '$userType'";

    //     $result = mysqli_query($this->conn, $sql);
    //     $rows = [];

    //     if ($result && mysqli_num_rows($result) > 0) {
    //         while ($row = mysqli_fetch_assoc($result)) {
    //             $rows[] = $row;
    //         }
    //     }

    //     return $rows;
    // }
}


?>

