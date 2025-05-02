<?php
include_once 'DbConnector.php'; // Ensure database connection is included

class PropertyDetails
{
    public $conn;

    // Class properties with default values corresponding to table columns.
    public $property_title = "";
    public $property_details_id = 0;
    public $status = 0;
    public $property_id = 0;
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
    public $modified = "";

    // Create a district map using ArrayObject
    public array $district_array;

    /**
     * Constructor: Initializes the database connection.
     */
    public function __construct()
    {
        $this->createDistrictMap(); //Mandatory to create district map
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
     * Create minimal tbl_property_details with only the property_details_id column if it does not exist.
     *
     * @return void
     */
    public function createTableMinimal()
    {
        $this->ensureConnection();
        $sql = "CREATE TABLE IF NOT EXISTS tbl_property_details (
                    property_details_id INT AUTO_INCREMENT PRIMARY KEY
                ) ENGINE=InnoDB";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            echo "Minimal table 'tbl_property_details' created successfully.<br>";
        } else {
            echo "Error creating minimal table 'tbl_property_details': " . mysqli_error($this->conn) . "<br>";
        }
    }

    /**
     * Alter table tbl_property_details to add additional columns.
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
        $table = "tbl_property_details";
        $alterQueries = [
            1  => ['status',                  "ALTER TABLE $table ADD COLUMN status INT DEFAULT 0"],
            2  => ['property_id',             "ALTER TABLE $table ADD COLUMN property_id INT"],
            3  => ['note_ids',                "ALTER TABLE $table ADD COLUMN note_ids TEXT"],
            4  => ['property_category',       "ALTER TABLE $table ADD COLUMN property_category VARCHAR(50)"],
            5  => ['area',                    "ALTER TABLE $table ADD COLUMN area DOUBLE"],
            6  => ['description',             "ALTER TABLE $table ADD COLUMN description TEXT"],
            7  => ['division',                "ALTER TABLE $table ADD COLUMN division TEXT"],
            8  => ['district',                "ALTER TABLE $table ADD COLUMN district TEXT"],
            9  => ['address',                 "ALTER TABLE $table ADD COLUMN address TEXT"],
            10 => ['google_location_url',     "ALTER TABLE $table ADD COLUMN google_location_url TEXT"],
            11 => ['bedroom_no',              "ALTER TABLE $table ADD COLUMN bedroom_no INT"],
            12 => ['bathroom_no',             "ALTER TABLE $table ADD COLUMN bathroom_no INT"],
            13 => ['price',                   "ALTER TABLE $table ADD COLUMN price DOUBLE"],
            14 => ['property_image_file_ids', "ALTER TABLE $table ADD COLUMN property_image_file_ids TEXT"],
            15 => ['property_video_file_ids', "ALTER TABLE $table ADD COLUMN property_video_file_ids TEXT"],
            16 => ['created',                 "ALTER TABLE $table ADD COLUMN created TIMESTAMP DEFAULT CURRENT_TIMESTAMP"],
            17 => ['modified',                "ALTER TABLE $table ADD COLUMN modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP"],
            18 => ['property_title',          "ALTER TABLE $table ADD COLUMN property_title VARCHAR(100) DEFAULT 'title'"]
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
     * Create a map of districts.
     *
     * @return void
     */
    public function createDistrictMap()
    {
        $this->district_array = [
            'Khulna' => 12,
            'Dhaka' => 13,
            'Rajshahi' => 14,
            'Chittagong' => 15,
        ];
    }

    /**
     * Insert a new property details record.
     * The 'created' and 'modified' columns are auto-generated by the database.
     *
     * @return int|false Returns the inserted property_details_id on success, or false on failure.
     */
    public function insert()
    {
        $this->ensureConnection();
        $sql = "INSERT INTO tbl_property_details (
                    property_title, status, property_id, note_ids, property_category, area, description, district, division, address,
                    google_location_url, bedroom_no, bathroom_no, price, property_image_file_ids, property_video_file_ids
                ) VALUES (
                    '$this->property_title',
                    $this->status,
                    $this->property_id,
                    '$this->note_ids',
                    '$this->property_category',
                    $this->area,
                    '$this->description',
                    '$this->district',
                    '$this->division',
                    '$this->address',
                    '$this->google_location_url',
                    $this->bedroom_no,
                    $this->bathroom_no,
                    $this->price,
                    '$this->property_image_file_ids',
                    '$this->property_video_file_ids'
                )";
        if (mysqli_query($this->conn, $sql)) {
            $this->property_details_id = mysqli_insert_id($this->conn);
            return $this->property_details_id;
        } else {
            echo "Insert failed: " . mysqli_error($this->conn) . "<br>";
            return false;
        }
    }

    /**
     * Update an existing property details record based on property_details_id.
     *
     * @return bool|string Returns true if update is successful, or an error message on failure.
     */
    public function update()
    {
        if ($this->property_details_id == 0) {
            return "Property details ID is not set. Cannot update.";
        }
        $sql = "UPDATE tbl_property_details SET
                    property_title = '$this->property_title',
                    status = $this->status,
                    property_id = $this->property_id,
                    note_ids = '$this->note_ids',
                    property_category = '$this->property_category',
                    area = $this->area,
                    description = '$this->description',
                    district = '$this->district',
                    division = '$this->division',
                    address = '$this->address',
                    google_location_url = '$this->google_location_url',
                    bedroom_no = $this->bedroom_no,
                    bathroom_no = $this->bathroom_no,
                    price = $this->price,
                    property_image_file_ids = '$this->property_image_file_ids',
                    property_video_file_ids = '$this->property_video_file_ids'
                WHERE property_details_id = $this->property_details_id";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            // echo "Property details record updated successfully.<br>";
        } else {
            // "Error updating record: " . mysqli_error($this->conn);
        }
        return $result;
    }
    /**
     * Set values of property details based on property_id and status.
     * If exactly one row is found, sets the class properties accordingly.
     *
     * @param int|null $property_id Specific property_id to load (optional).
     * @param int|null $status Status filter (optional).
     * @return array|false Returns array of results, false if no match.
     */
    public function setValueByPropertyId($property_id = null, $status = null)
    {
        $sql = "SELECT * FROM tbl_property_details WHERE 1";

        if ($property_id !== null) {
            $sql .= " AND property_id = $property_id";
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
     * @param int|null $user_id Specific user_id to load (optional).
     * @param int|null $status  Status filter (optional).
     * @return array|false Returns array of results, false if no match.
     */
    public function setValueByUserId($user_id = null, $status = null)
    {
        $sql = "SELECT * FROM tbl_property_details WHERE 1";
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
     * Set class properties based on an associative array of values.
     *
     * @param array $data Associative array with column values.
     */
    private function setProperties($data)
    {
        $this->property_title = $data['property_title'];
        $this->property_details_id = $data['property_details_id'];
        $this->status = $data['status'];
        $this->property_id = $data['property_id'];
        $this->note_ids = $data['note_ids'];
        $this->property_category = $data['property_category'];
        $this->area = $data['area'];
        $this->description = $data['description'];
        $this->district = $data['district'];
        $this->division = $data['division'];
        $this->address = $data['address'];
        $this->google_location_url = $data['google_location_url'];
        $this->bedroom_no = $data['bedroom_no'];
        $this->bathroom_no = $data['bathroom_no'];
        $this->price = $data['price'];
        $this->property_image_file_ids = $data['property_image_file_ids'];
        $this->property_video_file_ids = $data['property_video_file_ids'];
        $this->created = $data['created'];
        $this->modified = $data['modified'];
    }

    /**
     * Retrieve property details rows filtered by property_details_id and status.
     *
     * Both parameters are optional. If provided, the query filters the rows accordingly.
     *
     * @param int|null $property_details_id The property details ID to filter by. Default is null.
     * @param int|null $status The status to filter by. Default is null.
     * @return array Returns an array of associative arrays representing property details rows.
     */
    public function getRowsByDetailsIdAndStatus($property_details_id = null, $status = null)
    {
        $sql = "SELECT * FROM tbl_property_details WHERE 1";

        if ($property_details_id !== null) {
            $sql .= " AND property_details_id = " . intval($property_details_id);
        }

        if ($status !== null) {
            $sql .= " AND status = " . intval($status);
        }

        $result = mysqli_query($this->conn, $sql);
        $rows = [];

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }

        return $rows;
    }

    /**
     * Retrieve property details rows filtered by a list of property IDs and an optional status.
     *
     * @param array $property_ids An array of property IDs to filter by.
     * @param int|null $status The status to filter by (optional).
     * @return array An array of associative arrays representing the matching property details rows.
     */
    public function getRowsByPropertyIdsAndStatus(array $property_ids = [], $status = null)
    {
        // Start with a basic query
        $sql = "SELECT * FROM tbl_property_details WHERE 1";

        // If we have property IDs in the array, build an IN clause
        if (!empty($property_ids)) {
            // Safely convert each ID to an integer
            $idList = implode(',', array_map('intval', $property_ids));
            $sql .= " AND property_id IN ($idList)";
        }

        // If status is provided, add it to the query
        if ($status !== null) {
            $sql .= " AND status = " . intval($status);
        }

        // Execute the query
        $result = mysqli_query($this->conn, $sql);
        $rows = [];

        // Fetch and store the result set in an array
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }

        return $rows;
    }

    /**
     * Retrieve property details rows filtered by various criteria.
     *
     * @param string|null $propertyCategory The property category to filter by (e.g., 'residential', 'commercial').
     * @param string|null $division The division to filter by (e.g., 'Dhaka', 'Khulna').
     * @param int|null $bedroom The number of bedrooms to filter by.
     * @param int|null $bathroom The number of bathrooms to filter by.
     * @param float|null $minPrice The minimum price to filter by.
     * @param float|null $maxPrice The maximum price to filter by.
     * @param float|null $area The area (in square feet) to filter by.
     * @param int|null $status The status to filter by (optional).
     * @return array Returns an array of associative arrays representing the matching property details rows.
     */
    public function getFilteredProperties($propertyCategory = null, $division = null, $bedroom = null, $bathroom = null, $minPrice = null, $maxPrice = null, $area = null, $status = null)
    {
        // Start building the SQL query
        $sql = "SELECT * FROM tbl_property_details WHERE 1";

        // Add conditions based on the provided filter values
        if ($propertyCategory !== null) {
            $sql .= " AND property_category = '" . mysqli_real_escape_string($this->conn, $propertyCategory) . "'";
        }
        if ($division !== null) {
            $sql .= " AND division = '" . mysqli_real_escape_string($this->conn, $division) . "'";
        }
        if ($bedroom !== null) {
            $sql .= " AND bedroom_no = " . intval($bedroom);
        }
        if ($bathroom !== null) {
            $sql .= " AND bathroom_no = " . intval($bathroom);
        }
        if ($minPrice !== null) {
            $sql .= " AND price >= " . floatval($minPrice);
        }
        if ($maxPrice !== null) {
            $sql .= " AND price <= " . floatval($maxPrice);
        }
        if ($area !== null) {
            $sql .= " AND area >= " . floatval($area);
        }
        if ($status !== null) {
            $sql .= " AND status = " . intval($status);
        }

        // Execute the query
        $result = mysqli_query($this->conn, $sql);
        $rows = [];

        // Fetch and store the result set in an array
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
        }

        return $rows;
    }
}
?>

<!-- end -->