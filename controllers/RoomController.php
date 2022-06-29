<?php

class RoomController extends Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function getRooms() {
        $stmt = $this->conn->query("SELECT * FROM rooms");
        $results = $stmt->fetch_all(MYSQLI_ASSOC);
        var_dump($results);
    }

    public function getRoom($id) {
        $roomObj = new Room($this->conn);
        $roomObj->fetchRoom($id);
        $room = $roomObj->getRoom();
        include "views/single_room.php";
    }

    public function create() {
        $room = new Room($this->conn);
        if($room->validateRoom($this->req)->success()) {
           if($room->createNewRoom()->success()) {
            Messenger::setMsg("New room created!", "success");
            header("Location: " . ROOT . "rooms/get/" . $room->id);
           }
        } else {
            echo "this post has an error";
            $errors = $room->errors;
            include "views/create_room.php";
        }
    }
}