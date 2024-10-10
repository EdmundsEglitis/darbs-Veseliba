CREATE DATABASE veseliba;


CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` BOOLEAN NOT NULL DEFAULT false,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,          -- Username of the user
    email VARCHAR(255) NOT NULL UNIQUE,             -- Email of the user
    password_hash VARCHAR(255) NOT NULL,            -- Hashed password for security
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- Timestamp for when the user was created
);

CREATE TABLE WorkoutPlans (
    workout_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,                                    -- Foreign key to link to the Users table
    title VARCHAR(255) NOT NULL,                    -- Overall workout title, e.g., "Leg Day"
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp for when the workout plan is created
    FOREIGN KEY (user_id) REFERENCES Users(user_id)
    ON DELETE CASCADE                               -- Delete workout plan if the user is deleted
);

CREATE TABLE Exercises (
    exercise_id INT AUTO_INCREMENT PRIMARY KEY,
    workout_id INT,                                 -- Foreign key to link to the WorkoutPlans table
    exercise_name VARCHAR(255) NOT NULL,            -- Name of the exercise, e.g., "Squats"
    description TEXT NOT NULL,                      -- Description of the exercise
    photo_url VARCHAR(255),                         -- Optional field for photo URL of the exercise
    FOREIGN KEY (workout_id) REFERENCES WorkoutPlans(workout_id)
    ON DELETE CASCADE                               -- Delete exercises when the workout plan is deleted
);
