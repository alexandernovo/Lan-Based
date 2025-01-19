CREATE TABLE schedule (
    schedule_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    class_id INT(11) NOT NULL,
    monday int(2),
    tuesday int(2),
    wednesday int(2),
    thursday int(2),
    friday int(2),
    saturday int(2),
    sunday int(2),
    createdby int(255),
    created_at DATETIME
);

CREATE TABLE schedule_time (
    scheduletime_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    schedule_id INT(11) NOT NULL,
    timefrom TIME DEFAULT NULL,
    timeto TIME DEFAULT NULL,
    createdby int(255),
    created_at DATETIME
)