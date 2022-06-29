<?php

class Room {
    public $room_id;
    public $home_type;
    public $room_type;
    public $total_occupancy;
    public $total_bedrooms;
    public $total_bathrooms;
    public $summary;
    public $address;
    public $has_tv;
    public $has_kitchen;
    public $has_air_con;
    public $has_heating;
    public $has_internet;
    public $price;
    public $owner_id;
    public $created_at;
    public $conn;
    public $room = [];
    public $rooms = [];
    public $errors = [];

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function fetchRoom($id) {
        $this->room_id = $id;
        $sql = "SELECT *
                from rooms
                where id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $this->room_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->room = $result->fetch_assoc();
        var_dump($this->room);
        return $this;
    }

    public function getRoom() {
        return $this->room;
    }

    public function fetchRooms($offset = 0, $limit = 12) {
        $sql = "SELECT *
                FROM rooms";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->get_result();
        if($results->num_rows === 0) {
            $this->errors['fetch_err'] = "Couldn't retrieve resource!";
        } else {
            $this->rooms = $results->fetch_all(MYSQLI_ASSOC);
        }
        return $this;
    }

    public function getRooms() {
        return $this->rooms;
    }

    public function validateRoom($room) {
        $this->total_occupancy = htmlspecialchars($room['total_occupancy']);
        $this->total_bedrooms = htmlspecialchars($room['total_bedrooms']);
        $this->total_bathrooms = htmlspecialchars($room['total_bathrooms']);
        $this->address = htmlspecialchars($room['address']);
        $this->summary = htmlspecialchars($room['summary']);
        $this->price = htmlspecialchars($room['price']);

        if(empty($this->total_occupancy) || empty($this->total_bedrooms)
        || empty($this->total_bathrooms) || empty($this->address)
        || empty($this->summary) || empty($this->price)) {
            $this->errors['post_form_err'] = "New post fields cannot be empty!";
        }
        return $this;
    }

    public function createNewRoom() {
        // $this->post_img = "images/itec_blog_628df26139e79.jpeg";
        // $this->post_user_id = 1;
        $sql = "INSERT INTO `rooms` 
                (`id`, `home_type`, `room_type`, `total_occupancy`, `total_bedrooms`, `total_bathrooms`, `summary`, `address`, `has_tv`, `has_kitchen`, `has_air_con`, `has_heating`, `has_internet`, `price`, `owner_id`, `created_at`) 
                VALUES (NULL, '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', '?', CURRENT_TIMESTAMP);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssssssssss", $this->home_type, $this->room_type, $this->total_occupancy, $this->total_bedrooms, $this->total_bathrooms, $this->summary, $this->address, $this->has_tv, $this->has_kitchen, $this->has_air_con, $this->has_heating, $this->has_internet, $this->price, $this->owner_id, $this->created_at);
        $stmt->execute();
        if($stmt->affected_rows !== 1) {
            $this->errors['insert_err'] = "Room was not created!";
        } else {
            $this->id = $stmt->id;
        }
        return $this;
    }

    public function success() {
        if(empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
       $sql = "DELETE FROM rooms WHERE rooms.id = ?";
       $stmt = $this->conn->prepare($sql);
       $stmt->bind_param("s", $id);
       $stmt->execute();
       if($stmt->affected_rows !== 1) {
           $this->errors['delete_err'] = "Failed to delete room!";
       } 
       return $this;
    }

    public function update($room) {
        $this->total_occupancy = htmlspecialchars($room['total_occupancy']);
        $this->total_bedrooms = htmlspecialchars($room['total_bedrooms']);
        $this->total_bathrooms = htmlspecialchars($room['total_bathrooms']);
        $this->address = htmlspecialchars($room['address']);
        $this->summary = htmlspecialchars($room['summary']);
        $this->price = htmlspecialchars($room['price']);
        $sql = "UPDATE `rooms` 
                SET `home_type` = 'condo', `room_type` = 'prince room', `total_occupancy` = '4', `total_bedrooms` = '4', `total_bathrooms` = '4', `summary` = 'dep lem lem', `address` = '9 Hoang Minh Giam', `has_tv` = '2', `has_kitchen` = '2', `has_air_con` = '2', `has_heating` = '2', `has_internet` = '2', `owner_id` = '2' 
                WHERE `rooms`.`id` = 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $this->post_title, $this->post_body, $this->posrt_id);
        $stmt->execute();
        if($stmt->affected_rows !== 1) {
            $this->errors['update_err'] = "Failed to update room!";
        }
        return $this;
    }
}