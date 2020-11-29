
CREATE TABLE IF NOT EXISTS `migrations` (
  `version` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_assign_semester`
--

CREATE TABLE IF NOT EXISTS `msit_tb_assign_semester` (
`id` int(11) NOT NULL,
  `assign_semester_code` varchar(11) NOT NULL,
  `assign_dept` varchar(11) NOT NULL,
  `assign_batch` varchar(11) NOT NULL,
  `assign_section` varchar(11) NOT NULL,
  `assign_sub_code` varchar(20) NOT NULL,
  `assign_sub_name` varchar(300) NOT NULL,
  `assign_sub_cread` varchar(11) NOT NULL,
  `assign_reg_start_date` varchar(25) NOT NULL,
  `assign_reg_close_date` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_assign_teacher`
--

CREATE TABLE IF NOT EXISTS `msit_tb_assign_teacher` (
`id` int(11) NOT NULL,
  `semester_code` varchar(11) NOT NULL,
  `std_batch` varchar(11) NOT NULL,
  `std_section` varchar(15) NOT NULL,
  `sub_code` varchar(12) NOT NULL,
  `sub_name` varchar(150) NOT NULL,
  `sub_credit` varchar(10) NOT NULL,
  `assign_teacher` varchar(150) NOT NULL,
  `display_code` varchar(20) NOT NULL,
  `alternative_teacher` varchar(150) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_dept_info`
--

CREATE TABLE IF NOT EXISTS `msit_tb_dept_info` (
`id` int(11) NOT NULL,
  `dept_code` varchar(11) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `dept_sort_name` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_grade_point`
--

CREATE TABLE IF NOT EXISTS `msit_tb_grade_point` (
`id` int(11) NOT NULL,
  `gread` varchar(5) NOT NULL,
  `gread_point` varchar(5) NOT NULL,
  `form_mark` varchar(5) NOT NULL,
  `to_mark` varchar(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_issue_book_history`
--

CREATE TABLE IF NOT EXISTS `msit_tb_issue_book_history` (
`id` int(11) NOT NULL,
  `std_id` varchar(11) NOT NULL,
  `book_id` varchar(11) NOT NULL,
  `book_name` varchar(250) NOT NULL,
  `writer_name` varchar(250) NOT NULL,
  `issue_date` varchar(20) NOT NULL,
  `due_date` varchar(20) NOT NULL,
  `library_fine` int(11) DEFAULT NULL,
  `fine_paid` int(11) DEFAULT NULL,
  `return_type` int(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_library`
--

CREATE TABLE IF NOT EXISTS `msit_tb_library` (
`id` int(11) NOT NULL,
  `book_name` varchar(250) NOT NULL,
  `writer_name` varchar(200) NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `edition` varchar(100) DEFAULT NULL,
  `edition_year` varchar(5) DEFAULT NULL,
  `price` varchar(50) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `issued` int(10) DEFAULT NULL,
  `rack_no` varchar(20) NOT NULL,
  `add_date` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_notice`
--

CREATE TABLE IF NOT EXISTS `msit_tb_notice` (
`id` int(11) NOT NULL,
  `note_no` varchar(20) NOT NULL,
  `publish_date` varchar(20) NOT NULL,
  `note_subject` varchar(200) NOT NULL,
  `note_message` varchar(1000) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_notification`
--

CREATE TABLE IF NOT EXISTS `msit_tb_notification` (
`id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `notice_no` varchar(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_result`
--

CREATE TABLE IF NOT EXISTS `msit_tb_result` (
`id` int(11) NOT NULL,
  `assign_season` varchar(20) DEFAULT NULL,
  `assign_year` varchar(4) DEFAULT NULL,
  `semester_code` varchar(5) DEFAULT NULL,
  `std_display_id` varchar(11) DEFAULT NULL,
  `std_id` varchar(11) DEFAULT NULL,
  `std_name` varchar(150) DEFAULT NULL,
  `std_dept` varchar(11) DEFAULT NULL,
  `std_batch` varchar(11) DEFAULT NULL,
  `std_section` varchar(20) DEFAULT NULL,
  `sub_code` varchar(11) DEFAULT NULL,
  `sub_name` varchar(150) DEFAULT NULL,
  `sub_credit` varchar(5) DEFAULT NULL,
  `attendance` varchar(3) DEFAULT NULL,
  `class_test` varchar(4) DEFAULT NULL,
  `mid_exam` varchar(4) DEFAULT NULL,
  `final_exam` varchar(4) DEFAULT NULL,
  `total_number` varchar(4) DEFAULT NULL,
  `gpa_point` varchar(5) DEFAULT NULL,
  `grade_point` varchar(11) DEFAULT NULL,
  `action` varchar(2) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_semester_code`
--

CREATE TABLE IF NOT EXISTS `msit_tb_semester_code` (
`id` int(11) NOT NULL,
  `season_code` varchar(11) NOT NULL,
  `year_code` varchar(11) NOT NULL,
  `semester_code` varchar(11) NOT NULL,
  `action` varchar(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_settings`
--

CREATE TABLE IF NOT EXISTS `msit_tb_settings` (
`id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `tag_line` varchar(100) NOT NULL,
  `grade_scale` varchar(5) NOT NULL,
  `contact_no` varchar(16) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `address` varchar(250) NOT NULL,
  `site_logo` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_student_info`
--

CREATE TABLE IF NOT EXISTS `msit_tb_student_info` (
`id` int(11) NOT NULL,
  `std_display_id` varchar(15) NOT NULL,
  `std_id` varchar(15) NOT NULL,
  `std_name` varchar(150) NOT NULL,
  `std_dept` varchar(50) NOT NULL,
  `std_batch` varchar(30) NOT NULL,
  `std_section` varchar(20) NOT NULL,
  `required_credit` varchar(3) NOT NULL,
  `std_status` varchar(10) NOT NULL,
  `std_gender` varchar(50) NOT NULL,
  `std_religion` varchar(100) NOT NULL,
  `std_email_address` varchar(100) NOT NULL,
  `std_contact_no` varchar(15) NOT NULL,
  `access_type` varchar(2) NOT NULL,
  `library_access` int(2) NOT NULL,
  `std_complete_graduation` varchar(2) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_subject`
--

CREATE TABLE IF NOT EXISTS `msit_tb_subject` (
`id` int(11) NOT NULL,
  `subject_dept` varchar(11) NOT NULL,
  `subject_code` varchar(11) NOT NULL,
  `subject_name` varchar(150) NOT NULL,
  `subject_credit` varchar(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_teacher_info`
--

CREATE TABLE IF NOT EXISTS `msit_tb_teacher_info` (
`id` int(11) NOT NULL,
  `display_id` varchar(11) NOT NULL,
  `teacher_name` varchar(150) NOT NULL,
  `teacher_designation` varchar(100) NOT NULL,
  `teacher_department` varchar(100) NOT NULL,
  `date_of_join` varchar(20) NOT NULL,
  `teacher_gender` varchar(50) NOT NULL,
  `teacher_religion` varchar(50) NOT NULL,
  `email_address` varchar(150) NOT NULL,
  `contact_no` varchar(15) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `access_type` varchar(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_transport`
--

CREATE TABLE IF NOT EXISTS `msit_tb_transport` (
`id` int(11) NOT NULL,
  `route_from` varchar(200) NOT NULL,
  `route_to` varchar(200) NOT NULL,
  `vehicle_no` varchar(5) NOT NULL,
  `departure_time` varchar(150) NOT NULL,
  `yearly_fare` varchar(20) NOT NULL,
  `off_day` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_user`
--

CREATE TABLE IF NOT EXISTS `msit_tb_user` (
`id` int(11) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `user_full_name` varchar(150) NOT NULL,
  `email_address` varchar(150) NOT NULL,
  `contact_no` varchar(16) NOT NULL,
  `user_name` varchar(120) NOT NULL,
  `user_pass` varchar(50) NOT NULL,
  `forgot_password` varchar(150) DEFAULT NULL,
  `access_type` varchar(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `msit_tb_waiver`
--

CREATE TABLE IF NOT EXISTS `msit_tb_waiver` (
`id` int(11) NOT NULL,
  `std_display_id` varchar(20) NOT NULL,
  `std_id` varchar(20) NOT NULL,
  `std_name` varchar(150) NOT NULL,
  `std_dept` varchar(50) NOT NULL,
  `std_batch` varchar(50) NOT NULL,
  `std_section` varchar(50) NOT NULL,
  `sub_code` varchar(15) NOT NULL,
  `sub_name` varchar(150) NOT NULL,
  `sub_credit` varchar(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `msit_tb_assign_semester`
--
ALTER TABLE `msit_tb_assign_semester`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_assign_teacher`
--
ALTER TABLE `msit_tb_assign_teacher`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_dept_info`
--
ALTER TABLE `msit_tb_dept_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_grade_point`
--
ALTER TABLE `msit_tb_grade_point`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_issue_book_history`
--
ALTER TABLE `msit_tb_issue_book_history`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_library`
--
ALTER TABLE `msit_tb_library`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_notice`
--
ALTER TABLE `msit_tb_notice`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_notification`
--
ALTER TABLE `msit_tb_notification`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_result`
--
ALTER TABLE `msit_tb_result`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_semester_code`
--
ALTER TABLE `msit_tb_semester_code`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_settings`
--
ALTER TABLE `msit_tb_settings`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_student_info`
--
ALTER TABLE `msit_tb_student_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_subject`
--
ALTER TABLE `msit_tb_subject`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_teacher_info`
--
ALTER TABLE `msit_tb_teacher_info`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_transport`
--
ALTER TABLE `msit_tb_transport`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `msit_tb_user`
--
ALTER TABLE `msit_tb_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `msit_tb_waiver`
--
ALTER TABLE `msit_tb_waiver`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `msit_tb_assign_semester`
--
ALTER TABLE `msit_tb_assign_semester`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_assign_teacher`
--
ALTER TABLE `msit_tb_assign_teacher`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_dept_info`
--
ALTER TABLE `msit_tb_dept_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_grade_point`
--
ALTER TABLE `msit_tb_grade_point`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_issue_book_history`
--
ALTER TABLE `msit_tb_issue_book_history`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_library`
--
ALTER TABLE `msit_tb_library`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_notice`
--
ALTER TABLE `msit_tb_notice`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_notification`
--
ALTER TABLE `msit_tb_notification`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_result`
--
ALTER TABLE `msit_tb_result`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_semester_code`
--
ALTER TABLE `msit_tb_semester_code`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_settings`
--
ALTER TABLE `msit_tb_settings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_student_info`
--
ALTER TABLE `msit_tb_student_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_subject`
--
ALTER TABLE `msit_tb_subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_teacher_info`
--
ALTER TABLE `msit_tb_teacher_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_transport`
--
ALTER TABLE `msit_tb_transport`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_user`
--
ALTER TABLE `msit_tb_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `msit_tb_waiver`
--
ALTER TABLE `msit_tb_waiver`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
