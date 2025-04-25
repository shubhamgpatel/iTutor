

CREATE TABLE user_roles (
    id int PRIMARY KEY AUTO_INCREMENT,
    user_role varchar(50) NOT NULL
);

CREATE TABLE gender (
    id int PRIMARY KEY AUTO_INCREMENT,
    gender varchar(50) NOT NULL
);

CREATE TABLE users (
  id int PRIMARY KEY AUTO_INCREMENT,
  first_name	varchar(100) NOT NULL, 
  last_name	varchar(100)  NOT NULL,
  email	varchar(300)  NOT NULL,
  user_password	varchar(300) NOT NULL,
  phone_number	varchar(300) NOT NULL,
  date_of_birth	date,
  gender_id	int,
  role_id	int NOT NULL,
  created_datetime	datetime,
  updated_datetime	datetime,
  FOREIGN KEY(gender_id) REFERENCES gender(id),
  FOREIGN KEY(role_id) REFERENCES user_roles(id)
);

CREATE TABLE tutors (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_id	int,
  qualification	varchar(100) NOT NULL,
  experience	int NOT NULL,
  tutor_field	varchar(100) NOT NULL,
  hourly_rate	int NOT NULL,
  created_datetime	datetime,
  updated_datetime	datetime,
  FOREIGN KEY(user_id) REFERENCES users(id)
);

CREATE TABLE subjects (
  id int PRIMARY KEY AUTO_INCREMENT,
  title	varchar(200) NOT NULL,
  description	varchar(1000) NOT NULL,
  subject_field	varchar(100) NOT NULL,
  created_datetime	datetime,
  updated_datetime	datetime,
  FOREIGN KEY(tutor_id) REFERENCES tutors(id)
);

CREATE TABLE learning_materials (
  id int PRIMARY KEY AUTO_INCREMENT,
  title	varchar(200) NOT NULL,
  file_path	varchar(350) NOT NULL,
  tutor_id	int NOT NULL,
  subject_id	int NOT NULL,
  created_datetime	datetime,
  updated_datetime	datetime,
  FOREIGN KEY(tutor_id) REFERENCES tutors(id),
  FOREIGN KEY(subject_id) REFERENCES subjects(id)
);

CREATE TABLE job_post (
  id int PRIMARY KEY AUTO_INCREMENT,
  title	varchar(200) NOT NULL,
  description	text NOT NULL,
  created_datetime	datetime,
  updated_datetime	datetime
);

CREATE TABLE mock_tests (
  id int PRIMARY KEY AUTO_INCREMENT,
  tutor_id	int NOT NULL,
  subject_id int NOT NULL,
  title	varchar(50),
  description	varchar(200),
  created_datetime	datetime,
  updated_datetime	datetime,
  FOREIGN KEY(tutor_id) REFERENCES tutors(id),
  FOREIGN KEY(subject_id) REFERENCES subjects(id)
);

CREATE TABLE mock_questions (
  id int PRIMARY KEY AUTO_INCREMENT,
  tutor_id	int NOT NULL,
  subject_id	int NOT NULL,
  question varchar(200) NOT NULL,
  marks	int  NOT NULL,
  answer int,
  created_datetime	datetime,
  updated_datetime	datetime,
  FOREIGN KEY(tutor_id) REFERENCES tutors(id),
  FOREIGN KEY(subject_id) REFERENCES subjects(id)
);

CREATE TABLE mock_questions_options (
  id int PRIMARY KEY AUTO_INCREMENT,
  mock_question_id	int NOT NULL,
  option_value	varchar(200) NOT NULL,
  created_datetime	datetime,
  updated_datetime	datetime,
  FOREIGN KEY(mock_question_id) REFERENCES mock_questions(id)
);

CREATE TABLE mock_test_x_questions (
  id int PRIMARY KEY AUTO_INCREMENT,
  mock_test_id	int NOT NULL,
  mock_question_id	int NOT NULL,
  FOREIGN KEY(mock_test_id) REFERENCES mock_tests(id),
  FOREIGN KEY(mock_question_id) REFERENCES mock_questions(id)
);

CREATE TABLE mock_test_enroll (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_id	int NOT NULL,
  mock_test_id	int NOT NULL,
  optained_marks	int,
  created_datetime	datetime,
  updated_datetime	datetime,
  FOREIGN KEY(user_id) REFERENCES users(id),
  FOREIGN KEY(mock_test_id) REFERENCES mock_tests(id)
);

CREATE TABLE learning_rooms (
  id int PRIMARY KEY AUTO_INCREMENT,
  room_number	varchar(20) NOT NULL,
  created_datetime	datetime,
  updated_datetime	datetime
);

CREATE TABLE tutor_appointment_bookings	 (
  id int PRIMARY KEY AUTO_INCREMENT,
  user_id int NOT NULL,
  tutor_id	int NOT NULL,
  subject_id int NOT NULL,
  learning_room_id int NOT NULL,
  date_time	datetime NOT NULL,
  message	varchar(300) NOT NULL,
  is_confirmed	boolean,
  created_datetime	datetime,
  updated_datetime	datetime,
  FOREIGN KEY(user_id) REFERENCES users(id),
  FOREIGN KEY(tutor_id) REFERENCES tutors(id),
  FOREIGN KEY(subject_id) REFERENCES subjects(id),
  FOREIGN KEY(learning_room_id) REFERENCES learning_rooms(id)
);

CREATE TABLE weekdays	 (
  id int PRIMARY KEY AUTO_INCREMENT,
  day	varchar(50) NOT NULL
);

CREATE TABLE tutor_schedule_days	 (
  id int PRIMARY KEY AUTO_INCREMENT,
  tutor_id	int NOT NULL,
  day_id int NOT NULL,
  start_time	time NOT NULL,
  end_time	time NOT NULL,
  created_datetime	datetime,
  updated_datetime	datetime,
  FOREIGN KEY(tutor_id) REFERENCES tutors(id),
  FOREIGN KEY(day_id) REFERENCES weekdays(id)
);

CREATE TABLE contact_us	 (
  id int PRIMARY KEY AUTO_INCREMENT,
  phone_no varchar(20) NOT NULL,
  address	varchar(200)  NOT NULL,
  email	varchar(30) NOT NULL,
  latitude	double,
  longitude	double,
  created_datetime	datetime,
  updated_datetime	datetime
);

CREATE TABLE tutor_subject	 (
  id int PRIMARY KEY AUTO_INCREMENT,
  tutor_id	int NOT NULL,
  subject_id int NOT NULL,
  FOREIGN KEY(tutor_id) REFERENCES tutors(id),
  FOREIGN KEY(subject_id) REFERENCES tutors(id)
);

CREATE TABLE job_applications	 (
  id int PRIMARY KEY AUTO_INCREMENT,
  firstname	varchar(100) NOT NULL,
  lastname	varchar(100) NOT NULL,
  email	varchar(300) NOT NULL,
  phone_number	varchar(300) NOT NULL,
  resume_filename varchar(300) NOT NULL,
  applied_on datetime,
  job_id int NOT NULL,
  FOREIGN KEY(job_id) REFERENCES job_post(id),
);

CREATE TABLE faqs	 (
  id int PRIMARY KEY AUTO_INCREMENT,
  question	varchar(200) NOT NULL,
  answer	varchar(1000) NOT NULL,
  created_datetime	datetime,
  updated_datetime	datetime
);

CREATE TABLE tutor_ratings	 (
  id int PRIMARY KEY AUTO_INCREMENT,
  tutor_id	int NOT NULL,
  rating	float NOT NULL,
  comment	varchar(200),
  created_datetime	datetime,
  updated_datetime	datetime,
  FOREIGN KEY(tutor_id) REFERENCES tutors(id)
);