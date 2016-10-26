
--
-- Structure of table `lights`
--

CREATE TABLE IF NOT EXISTS `lights` (
`id` int(8) NOT NULL,
  `type` varchar(8) NOT NULL,
  `state` int(2) NOT NULL,
  `date` varchar(64) NOT NULL,
  `browser` varchar(32) NOT NULL,
  `os` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=845 DEFAULT CHARSET=latin1;

--
-- Example data for table `lights`
--

INSERT INTO `lights` (`id`, `type`, `state`, `date`, `browser`, `os`) VALUES
(1, '2', 0, '20:10:20 04/10/2016', 'Android', 'Handheld Browser'),
(2, '2', 1, '18:10:57 13/10/2016', 'Safari', 'Mac OS X'),
(3, '25', 1, '18:10:58 13/10/2016', 'Safari', 'Mac OS X'),
(4, '4', 0, '11:10:27 20/10/2016', 'Firefox', 'Linux'),
(5, '4', 0, '22:10:58 20/10/2016', 'Handheld Browser', 'Android')

--
-- Indexes for table `lights`
--
ALTER TABLE `lights`
 ADD PRIMARY KEY (`id`);

 
ALTER TABLE `lights`
	MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
