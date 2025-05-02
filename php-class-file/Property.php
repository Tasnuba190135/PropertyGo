<?php
include_once 'DbConnector.php'; // Ensure database connection is included

class Property
{
    public $conn;

    // Class properties with default values corresponding to table columns.
    public $property_id = 0;
    public $status = 0;
    public $user_id = 0;
    public $sold_to = 0;
    public $property_title = "";
    public $note_ids = "";
    public $property_category = "";
    public $area = 0.0;
    public $description = "";
    public $division = "";
    public $district = "";
    public $address = "";
    public $google_location_url = "";
    public $bedroom_no = 0;
    public $bathroom_no = 0;
    public $price = 0.0;
    public $property_image_file_ids = "";
    public $property_video_file_ids = "";
    public $created = "";
    public $updated = "";
    public $posted = ""; // This column is manually updated by user
    public $parent_property_id = 0; // This column is manually updated by user

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
        } else {
            return 0;
        }
    }

    /**
     * Create minimal tbl_property with only the property_id column if it does not exist.
     *
     * @return void
     */
    public function createTableMinimal()
    {
        $this->ensureConnection();
        $sql = "CREATE TABLE IF NOT EXISTS tbl_property (
                    property_id INT AUTO_INCREMENT PRIMARY KEY
                ) ENGINE=InnoDB";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            echo "Minimal table 'tbl_property' created successfully.<br>";
        } else {
            echo "Error creating minimal table 'tbl_property': " . mysqli_error($this->conn) . "<br>";
        }
    }

    /**
     * Alter table tbl_property to add additional columns.
     *
     * Each query is defined as a map entry where the key is a number and the value is an array:
     * [column name, SQL query].
     *
     * @param array|null $selectedNums Optional array of keys. If provided, only those queries run.
     * @return void
     */
    public function alterTableAddColumns($selectedNums = null)
    {
        $this->ensureConnection();
        $table = "tbl_property";
        $alterQueries = [
            1  => ['status',                  "ALTER TABLE $table ADD COLUMN status INT DEFAULT 0"],
            2  => ['user_id',                 "ALTER TABLE $table ADD COLUMN user_id INT DEFAULT 0"],
            3  => ['sold_to',                 "ALTER TABLE $table ADD COLUMN sold_to INT DEFAULT 0"],
            4  => ['property_title',          "ALTER TABLE $table ADD COLUMN property_title VARCHAR(100) DEFAULT ''"],
            5  => ['note_ids',                "ALTER TABLE $table ADD COLUMN note_ids TEXT"],
            6  => ['property_category',       "ALTER TABLE $table ADD COLUMN property_category VARCHAR(50) DEFAULT ''"],
            7  => ['area',                    "ALTER TABLE $table ADD COLUMN area DOUBLE DEFAULT 0.0"],
            8  => ['description',             "ALTER TABLE $table ADD COLUMN description TEXT"],
            9  => ['division',                "ALTER TABLE $table ADD COLUMN division VARCHAR(50) DEFAULT ''"],
            10 => ['district',                "ALTER TABLE $table ADD COLUMN district VARCHAR(50) DEFAULT ''"],
            11 => ['address',                 "ALTER TABLE $table ADD COLUMN address TEXT"],
            12 => ['google_location_url',     "ALTER TABLE $table ADD COLUMN google_location_url TEXT"],
            13 => ['bedroom_no',              "ALTER TABLE $table ADD COLUMN bedroom_no INT DEFAULT 0"],
            14 => ['bathroom_no',             "ALTER TABLE $table ADD COLUMN bathroom_no INT DEFAULT 0"],
            15 => ['price',                   "ALTER TABLE $table ADD COLUMN price DOUBLE DEFAULT 0.0"],
            16 => ['property_image_file_ids', "ALTER TABLE $table ADD COLUMN property_image_file_ids TEXT"],
            17 => ['property_video_file_ids', "ALTER TABLE $table ADD COLUMN property_video_file_ids TEXT"],
            18 => ['created',                 "ALTER TABLE $table ADD COLUMN created TIMESTAMP DEFAULT CURRENT_TIMESTAMP"],
            19 => ['updated',                 "ALTER TABLE $table ADD COLUMN updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"],
            20 => ['posted',                  "ALTER TABLE $table ADD COLUMN posted TIMESTAMP NULL DEFAULT NULL"],
            21 => ['parent_property_id',      "ALTER TABLE $table ADD COLUMN parent_property_id INT DEFAULT 0"]
        ];

        // Optionally filter the alter queries if specific keys are provided.
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
     * Insert a new property details record.
     * The 'created' and 'updated' columns are auto-generated by the database.
     * Note: The 'posted' field is not included in the insert as it is meant to be updated manually.
     *
     * @return int|false Returns the inserted property_id on success, or false on failure.
     */
    public function insert()
    {
        $this->ensureConnection();

        // In-place escape for all text fields
        $this->property_title           = mysqli_real_escape_string($this->conn, $this->property_title);
        $this->note_ids                 = mysqli_real_escape_string($this->conn, $this->note_ids);
        $this->property_category        = mysqli_real_escape_string($this->conn, $this->property_category);
        $this->description              = mysqli_real_escape_string($this->conn, $this->description);
        $this->district                 = mysqli_real_escape_string($this->conn, $this->district);
        $this->division                 = mysqli_real_escape_string($this->conn, $this->division);
        $this->address                  = mysqli_real_escape_string($this->conn, $this->address);
        $this->google_location_url      = mysqli_real_escape_string($this->conn, $this->google_location_url);
        $this->property_image_file_ids  = mysqli_real_escape_string($this->conn, $this->property_image_file_ids);
        $this->property_video_file_ids  = mysqli_real_escape_string($this->conn, $this->property_video_file_ids);

        // Build and execute the INSERT
        $sql = "INSERT INTO tbl_property (
                property_title,
                status,
                user_id,
                sold_to,
                note_ids,
                property_category,
                area,
                description,
                district,
                division,
                address,
                google_location_url,
                bedroom_no,
                bathroom_no,
                price,
                property_image_file_ids,
                property_video_file_ids,
                parent_property_id
            ) VALUES (
                '{$this->property_title}',
                {$this->status},
                {$this->user_id},
                {$this->sold_to},
                '{$this->note_ids}',
                '{$this->property_category}',
                {$this->area},
                '{$this->description}',
                '{$this->district}',
                '{$this->division}',
                '{$this->address}',
                '{$this->google_location_url}',
                {$this->bedroom_no},
                {$this->bathroom_no},
                {$this->price},
                '{$this->property_image_file_ids}',
                '{$this->property_video_file_ids}',
                {$this->parent_property_id}
            )";

        if (mysqli_query($this->conn, $sql)) {
            $this->property_id = mysqli_insert_id($this->conn);
            return $this->property_id;
        } else {
            echo "Insert failed: " . mysqli_error($this->conn) . "<br>";
            return false;
        }
    }


    /**
     * Update an existing property details record based on property_id.
     *
     * @return bool|string Returns true if update is successful, or an error message on failure.
     */
    /**
 * Update an existing property details record based on property_id.
 * Escapes all text fields and handles errors similarly to insert().
 *
 * @return int|false Returns number of affected rows on success, or false on failure.
 */
public function update()
{
    if ($this->property_id == 0) {
        echo "Update failed: Property ID is not set.<br>";
        return false;
    }

    $this->ensureConnection();

    // In-place escape for all text fields
    $this->property_title          = mysqli_real_escape_string($this->conn, $this->property_title);
    $this->note_ids                = mysqli_real_escape_string($this->conn, $this->note_ids);
    $this->property_category       = mysqli_real_escape_string($this->conn, $this->property_category);
    $this->description             = mysqli_real_escape_string($this->conn, $this->description);
    $this->district                = mysqli_real_escape_string($this->conn, $this->district);
    $this->division                = mysqli_real_escape_string($this->conn, $this->division);
    $this->address                 = mysqli_real_escape_string($this->conn, $this->address);
    $this->google_location_url     = mysqli_real_escape_string($this->conn, $this->google_location_url);
    $this->property_image_file_ids = mysqli_real_escape_string($this->conn, $this->property_image_file_ids);
    $this->property_video_file_ids = mysqli_real_escape_string($this->conn, $this->property_video_file_ids);
    $this->posted                  = mysqli_real_escape_string($this->conn, $this->posted);

    // Build and execute the UPDATE
    $sql = "UPDATE tbl_property SET
                status = {$this->status},
                user_id = {$this->user_id},
                sold_to = {$this->sold_to},
                property_title = '{$this->property_title}',
                note_ids = '{$this->note_ids}',
                property_category = '{$this->property_category}',
                area = {$this->area},
                description = '{$this->description}',
                district = '{$this->district}',
                division = '{$this->division}',
                address = '{$this->address}',
                google_location_url = '{$this->google_location_url}',
                bedroom_no = {$this->bedroom_no},
                bathroom_no = {$this->bathroom_no},
                price = {$this->price},
                property_image_file_ids = '{$this->property_image_file_ids}',
                property_video_file_ids = '{$this->property_video_file_ids}',
                posted = '{$this->posted}',
                parent_property_id = {$this->parent_property_id}
            WHERE property_id = {$this->property_id}";

    if (mysqli_query($this->conn, $sql)) {
        return mysqli_affected_rows($this->conn);
    } else {
        echo "Update failed: " . mysqli_error($this->conn) . "<br>";
        return false;
    }
}


    /**
     * Update the status of an existing property record based on property_id.
     * 
     * @param int $property_id The ID of the property to update.
     * @param int $status The new status to set for the property.
     * @return bool|string Returns true if update is successful, or an error message on failure.
     */
    public function updateStatus($property_id, $status)
    {
        if ($property_id == 0) {
            return 0;
        }
        $sql = "UPDATE tbl_property SET status = $status WHERE property_id = $property_id";
        $result = mysqli_query($this->conn, $sql);
        return $result ? true : false;
    }

    /**
     * Set all values of a property record by property_id.
     * Set the property id in the object before calling this method.
     */
    public function setValue()
    {
        $this->getByPropertyIdAndStatus($this->property_id);
    }

    /**
     * Get values of property details based on property_id and status.
     * If exactly one row is found, sets the class properties accordingly.
     *
     * @param int|null $property_id Specific property_id to load (optional).
     * @param mixed|null $status Single status value or array of status values to filter by (optional).
     * @param string|null $order_by_col Order by column (e.g., "created", "modified" (maps to "updated"), or "posted").
     * @param string|null $order_type Order type (e.g., "ASC" or "DESC").
     * @return array|false Returns an array of results or false if no match.
     */
    public function getByPropertyIdAndStatus($property_id = null, $status = null, $order_by_col = null, $order_type = null)
    {
        $sql = "SELECT * FROM tbl_property WHERE 1";

        if ($property_id !== null) {
            $sql .= " AND property_id = $property_id";
        }

        if ($status !== null && is_array($status)) {
            $escaped_status = array_map(function ($value) {
                return intval($value);
            }, $status);
            $status_list = implode(',', $escaped_status);
            $sql .= " AND status IN ($status_list)";
        } elseif ($status !== null) {
            $sql .= " AND status = " . intval($status);
        }

        if ($order_by_col !== null) {
            $sql .= " ORDER BY $order_by_col";
        }

        if ($order_type !== null) {
            $sql .= " $order_type";
        }

        $result = mysqli_query($this->conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            if (count($data) === 1) {
                $this->setProperties($data[0]);
            }
            return $data;
        }
        return false;
    }

    /**
     * Get values of property details based on user_id and status.
     * If exactly one row is found, sets the class properties accordingly.
     *
     * @param int|null $user_id Specific user_id to load (optional).
     * @param mixed|null $status Single status value or array of status values to filter by (optional).
     * @param string|null $order_by_col Order by column (e.g., "created", "modified" (maps to "updated"), or "posted").
     * @param string|null $order_type Order type (e.g., "ASC" or "DESC").
     * @return array|false Returns an array of results or false if no match.
     */
    public function getByUserIdAndStatus($user_id = null, $status = null, $order_by_col = null, $order_type = null)
    {
        $sql = "SELECT * FROM tbl_property WHERE 1";

        if ($user_id !== null) {
            $sql .= " AND user_id = $user_id";
        }

        if ($status !== null && is_array($status)) {
            $escaped_status = array_map(function ($value) {
                return intval($value);
            }, $status);
            $status_list = implode(',', $escaped_status);
            $sql .= " AND status IN ($status_list)";
        } elseif ($status !== null) {
            $sql .= " AND status = " . intval($status);
        }

        if ($order_by_col !== null) {
            $sql .= " ORDER BY $order_by_col";
        }

        if ($order_type !== null) {
            $sql .= " $order_type";
        }

        $result = mysqli_query($this->conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            if (count($data) === 1) {
                $this->setProperties($data[0]);
            }
            return $data;
        }
        return false;
    }

    /**
     * Set class properties based on an associative array of values.
     *
     * @param array $data Associative array with column values.
     */
    public function setProperties($data)
    {
        // echo $data['property_title'] . "<br>";
        $this->property_id = $data['property_id'];
        $this->status = $data['status'];
        $this->user_id = $data['user_id'];
        $this->sold_to = $data['sold_to'];
        $this->property_title = $data['property_title'];
        $this->note_ids = $data['note_ids'];
        $this->property_category = $data['property_category'];
        $this->area = $data['area'];
        $this->description = $data['description'];
        $this->division = $data['division'];
        $this->district = $data['district'];
        $this->address = $data['address'];
        $this->google_location_url = $data['google_location_url'];
        $this->bedroom_no = $data['bedroom_no'];
        $this->bathroom_no = $data['bathroom_no'];
        $this->price = $data['price'];
        $this->property_image_file_ids = $data['property_image_file_ids'];
        $this->property_video_file_ids = $data['property_video_file_ids'];
        $this->created = $data['created'];
        $this->updated = $data['updated'];
        $this->posted = isset($data['posted']) ? $data['posted'] : "";
        $this->parent_property_id = $data['parent_property_id'];
    }

    /**
     * Get the most recent property records for each division.
     *
     * This function retrieves an associative array of divisions using getDivisions(),
     * then for each division key, it fetches the property records from tbl_property
     * ordered by the given column and order type, limited to a specified number of rows,
     * and optionally filtered by status.
     *
     * @param mixed|null $status Single status value or array of status values to filter by (optional). Default is null.
     * @param string $order_by_col Column to order by. Default is 'posted'.
     * @param string $order_type Order type (e.g., "ASC" or "DESC"). Default is 'DESC'.
     * @param int $limit Maximum number of rows per division. Default is 5.
     * @return array An associative array where the keys are division names and the values are arrays of property rows.
     */
    public function getRecentRowsForEachDivision($status = null, $order_by_col = 'posted', $order_type = 'DESC', $limit = 5)
    {
        $this->ensureConnection();
        require_once 'Division.php';
        $divisions = getDivisions();
        $result = [];
        foreach ($divisions as $divisionName => $divisionInfo) {
            $sql = "SELECT * FROM tbl_property 
                WHERE division = '" . mysqli_real_escape_string($this->conn, $divisionName) . "'";

            // Add status filter if provided
            if ($status !== null) {
                if (is_array($status)) {
                    $escaped_status = array_map(function ($value) {
                        return intval($value);
                    }, $status);
                    $status_list = implode(',', $escaped_status);
                    $sql .= " AND status IN ($status_list)";
                } else {
                    $sql .= " AND status = " . intval($status);
                }
            }

            $sql .= " ORDER BY $order_by_col $order_type LIMIT $limit";
            $query = mysqli_query($this->conn, $sql);
            if ($query) {
                $rows = [];
                while ($row = mysqli_fetch_assoc($query)) {
                    $rows[] = $row;
                }
                $result[$divisionName] = $rows;
            } else {
                $result[$divisionName] = [];
                echo "Error fetching rows for division " . $divisionName . ": " . mysqli_error($this->conn) . "<br>";
            }
        }
        return $result;
    }
}


?>


<!-- end of the file -->