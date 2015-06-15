-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 166.62.8.53
-- Generation Time: Sep 15, 2014 at 01:17 AM
-- Server version: 5.5.37
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `selfaw`
--

-- --------------------------------------------------------

--
-- Table structure for table `sas_adminusers`
--


CREATE TABLE `sas_adminusers` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(250) NOT NULL DEFAULT '',
  `last_name` varchar(250) NOT NULL DEFAULT '',
  `email` varchar(250) NOT NULL DEFAULT '',
  `username` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(250) NOT NULL DEFAULT '',
  `date_added` date NOT NULL DEFAULT '0000-00-00',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sas_adminusers`
--

INSERT INTO `sas_adminusers` VALUES(1, 'selfawarestories', 'self', 'meghs7@gmail.com', 'admin', 'admin11', '0000-00-00', 1);
INSERT INTO `sas_adminusers` VALUES(2, 'Harsha', 'Harsha', 'harsha.aluri@yahoo.com', 'harsha', 'harsha', '2014-08-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sas_characters`
--

CREATE TABLE `sas_characters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `title` varchar(60) NOT NULL,
  `photopath` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sas_characters`
--

INSERT INTO `sas_characters` VALUES(1, 'Krish', 'Krish: Technical Lead', 'cov034314_new-krish.png', '<div>Krish is the lead on a technical project team in a reputed company. &nbsp;He is in his early 30s. Krish is very smart, self-confident, and aware of how people perceive him. &nbsp;People who work with him think he makes a very good team mate. &nbsp;&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>He has always been easy to work with but exhibits few behaviors that are annoying. People in his team usually focus on the quality of the work he produces and ignore these small behaviors even if they are annoying. Deepak from the deployment team is now finding Krish&rsquo;s behavior very annoying and has very little patience to deal with Krish&rsquo;s bad behaviors at work.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Krish thinks Deepak is over-reacting as nobody in the past has complained about his behavior. Krish is aware of the way people perceive him, but he has never given enough thought to his behavior as he thinks it is not causing any major trouble to him or others. So he completely ignores the feedback/indications that people give him.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Krish doesn&rsquo;t do it intentionally but because he doesn&rsquo;t seem to improve or think it is a problem it sometimes comes across as rude behavior.</div>\r\n<div>&nbsp;</div>\r\n<div><b>Krish&rsquo;s Role:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Technical Lead</div>\r\n<div>&nbsp;</div>\r\n<div><b>Krish&rsquo;s Short Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Work smart&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Come across as a confident and competent person</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Be the best in the technical field&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Krish&rsquo;s Long Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To be able to work on cross cultural projects</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To be able to lead more projects&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To get recognized and be promoted</div>\r\n<div>&nbsp;</div>', 2, 1, 1);
INSERT INTO `sas_characters` VALUES(2, 'Suma', 'Suma: Deployment Team Lead', 'cov034634_new-suma.png', '<p>Suma works with Deepak on the deployment team. She is in her late 20s. &nbsp;She is quiet, observant and thoughtful. Suma speaks clearly and with insight, but is shy and non-assertive.&nbsp;&nbsp;</p>\r\n<div>Suma is very intuitive and identifies problems that can cause disastrous results. Deepak who is leading Suma in her current project is very happy with her work and appreciates her intuitive skills. Suma has problems being assertive even though she knows what she is talking about. Suma needs to be in a team that acknowledges and appreciates her work. She feels lucky to be a part of Deepak&rsquo;s team who focuses a lot on the quality of work. &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Suma is having a problem talking to Krish. She finds it difficult to put forth her observations, but she does it with Deepak&rsquo;s support and encouragement. &nbsp;When Krish doesn&rsquo;t seem to be paying attention, she doesn&rsquo;t know how to deal with the situation.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Suma is comfortable working on her own or on teams that are familiar to her. She is a little hesitant in working with new people or new teams.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Suma&rsquo;s Role:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Team Member</div>\r\n<div>&nbsp;</div>\r\n<div><b>Suma&rsquo;s Short Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Work well in a team&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Able to be more assertive&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To be able to convince people on her team and other teams</div>\r\n<div>&nbsp;</div>\r\n<div><b>Suma&rsquo;s Long Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To work on cross-cultural projects</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To get recognized for her work</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To work hard and get promoted&nbsp;</div>\r\n<div>&nbsp;</div>', 2, 1, 1);
INSERT INTO `sas_characters` VALUES(3, 'Deepak', 'Deepak: Deployment Team Lead', 'cov035008_new-deepak.png', '<p>Deepak is the lead on the deployment team in a reputed company. &nbsp;He is in his early 30s. He works on the same project as Krish and Suma. He is competent, and aware. &nbsp;He is a conscientious worker, and doesn&rsquo;t like wasting time or people who don&rsquo;t do a good job. &nbsp;His people skills are average.&nbsp;</p>\r\n<div>Deepak&rsquo;s patience levels are low and he easily loses his temper. At work he tries not to lose his temper easily. People in his team are happy working with him. He doesn&rsquo;t talk much and only focuses on getting the work done. &nbsp;Some people at work like him for this as the work gets done on time. Some people find him difficult as he is too stiff in his approach and his working style is not very easy to adapt. &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Deepak is very direct when he gives feedback. People who are not open to feedback or don&rsquo;t like him find it very offensive.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>He is working on a project with Krish and is very direct in giving feedback. He is angry when Krish doesn&rsquo;t take him seriously and ignores his feedback.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Deepak&rsquo;s Role:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Lead of Deployment Team</div>\r\n<div>&nbsp;</div>\r\n<div><b>Deepak&rsquo;s Short Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Work well in a team&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Be able to give feedback effectively</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Develop people skills &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Deepak&rsquo;s Long Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To be able to work on different projects with people at different levels&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To be able to lead more projects&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To get recognized and be promoted</div>\r\n<div>&nbsp;</div>', 2, 1, 1);
INSERT INTO `sas_characters` VALUES(4, 'Ram', 'Ram: New Hire', 'cov035552_ram.png', '<p>Ram just started a new job in a technical field. He just graduated from University with a Masters in Information Technology. He is technically competent and computer savvy.<span style="font-size: 12px;">&nbsp;&nbsp;</span>&nbsp;</p>\r\n<div>He has always been a topper during his academic life. His education has prepared him with the foundation that is required to be successful in terms of technology, but he doesn&rsquo;t have people skills. Currently he is in his first job and the workplace is not exactly what he thought it would be. Also he doesn&rsquo;t know where he is going wrong because he doesn&rsquo;t take feedback well. Because he always has been a good student technically, and because his parents have always been very positive in their support for him, he has not learned how to receive feedback. He is not a good team player, but he doesn&rsquo;t see the issues he causes. &nbsp;He believes that problems working on teams are caused by others, and not by him. Ram also exhibits other behaviors that make him difficult to work with, such as interrupting, not being an attentive listener, and simply not being aware of what is going on around him with other people.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Ram is having a tough time in his first job, and he is struggling with how to address the problems he is facing. &nbsp;At college he just had to do his assignments on time, prepare for exams and perform well. At work he thinks everyone is picking on him for no reason, and he doesn&rsquo;t know how to cope with this situation. Since Ram was a topper at school, and since he has friends who are not facing these difficulties in their job, Ram thinks it&rsquo;s the people in the organization and he is very anxious to tell them that they are the problem.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Some people at work are trying to give him feedback, which he finds very insulting. &nbsp; Ram also has issues working with women, he doesn&rsquo;t intentionally hurt or harm women but he is very egoistic in his approach.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Ram is also not sure if he should talk to his manager about a few people at work as this is his first job and he&rsquo;s worried about the repercussions. He tries to get the message across subtly but ends up creating awkward situations for himself and his team. &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Ram&rsquo;s Role:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Software Engineer</div>\r\n<div><b>Ram&rsquo;s Short Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Work smart&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Enjoy work</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Come across as a confident and competent person</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Develop technical skills required at work</div>\r\n<div><b>Ram&rsquo;s Long Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To be able to work on cross cultural projects</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To get recognized and be promoted</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To be a Senior Software Professional&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Develop a network of career professionals</div>\r\n<div>&nbsp;</div>\r\n<p>&nbsp;</p>', 8, 2, 1);
INSERT INTO `sas_characters` VALUES(5, 'Hemant', 'Hemant: Team Manager', 'cov035918_hemanth.png', '<p>&nbsp;</p>\r\n<div>Hemant is the team manager. Hemant is pleased with his team, and proud of what they have accomplished lately. He is also proud and happy that his team is growing, a recognition from management that they trust him. Hemant sees some miscommunication between the team members but he also sees Meera taking responsibility for the miscommunication. His calm and composed nature has got him to the position of being a Team Manager.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Manoj has the characteristics of being a good team manager and he manages even the difficult situations with a lot of ease.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Hemant&rsquo;s Role:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Team Manager</div>\r\n<div>&nbsp;</div>\r\n<div><b>Hemant&rsquo;s Short Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Hone his managerial skills</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Hone his mentoring skills</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Manage his team well&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Be patient with this team members</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Being able to take the team&rsquo;s failures in his stride&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Hemant&rsquo;s Long Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To get promoted &nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To lead teams of teams &nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Be an efficient leader&nbsp;</div>\r\n<div>&nbsp;</div>', 8, 2, 1);
INSERT INTO `sas_characters` VALUES(6, 'Manoj', 'Manoj: Marketing Lead ', 'cov040249_manoj.png', '<p>Manoj is a marketing lead with decades of experience. He is quiet, introverted and doesn''t speak much. Manoj is asked to mentor a new hire Ram but he is not a trained mentor. &nbsp;He doesn''t know what to do, or expect, as a mentor. &nbsp;So far, the mentoring has mostly been Ram telling Manoj about the problems Ram sees at the company. &nbsp;This upsets Manoj, but he works hard to not show it. He also discusses Ram&rsquo;s behavior with his co-worker Meera. He also assigns work to Ram where he would have to work with Meera but the results are disastrous</p>\r\n<div>Manoj realizes that being technically competent has very little do with mentoring. He is able to give some amount of feedback on technical aspects but he fails to give on behavior. His feedback styles are not very effective and giving feedback is definitely a skill that Manoj has to work on.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Manoj&rsquo;s Role:</strong></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Marketing Lead</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Manoj&rsquo;s Short Term Goals:</strong></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Come across as a confident and competent person</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Hone his marketing skills&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Being able to be &nbsp;a good mentor</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Being able to provide feedback in an effective manner&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Manoj&rsquo;s Long Term Goals:</strong></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Develop leadership skills &nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Lead more teams&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To get promoted</div>\r\n<div>&nbsp;</div>', 8, 2, 1);
INSERT INTO `sas_characters` VALUES(7, 'Meera', 'Meera: Senior Employee', 'cov040613_meera.png', '<p>Meera is a senior employee with several years of experience. She is quiet, observant and thoughtful. Speaks clearly and with insight, but is shy and non-assertive. She tries to be assertive but somehow gets caught up in the situation and isn&rsquo;t very effective.&nbsp;&nbsp;</p>\r\n<div>She is constantly giving feedback to a new hire in the current project but he clearly doesn&rsquo;t pick the cues. She is unable to get through to him and tries really hard. She even speaks to her co-worker Manoj who is leading the team to mentor the new hire.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Meera also comes across as a good mentor and coaches a female new hire who is finding it difficult to work in a team that is dominated by men.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Meera has all the characteristics of being a good mentor and an excellent team player. &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Meera&rsquo;s Role:</strong></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Senior Software Engineer</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Meera&rsquo;s Short Term Goals:</strong></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Good team player</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Coach and mentor people to drive the team towards success</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Create a positive environment&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Meera&rsquo;s Long Term Goals:</strong></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Be successful at work&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Be a leader&nbsp;</div>\r\n<div>&nbsp;</div>', 8, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sas_chars`
--

CREATE TABLE `sas_chars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `char_name` varchar(60) NOT NULL,
  `title` text NOT NULL,
  `photopath` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `sas_chars`
--

INSERT INTO `sas_chars` VALUES(4, 1, 1, 'Krish', 'Krish: Technical Lead', 'cov034314_new-krish.png', '<div>\r\n<div>Krish is the lead on a technical project team in a reputed company. &nbsp;He is in his early 30s. Krish is very smart, self-confident, and aware of how people perceive him. &nbsp;People who work with him think he makes a very good team mate. &nbsp;&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>He has always been easy to work with but exhibits few behaviors that are annoying. People in his team usually focus on the quality of the work he produces and ignore these small behaviors even if they are annoying. Deepak from the deployment team is now finding Krish&rsquo;s behavior very annoying and has very little patience to deal with Krish&rsquo;s bad behaviors at work.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Krish thinks Deepak is over-reacting as nobody in the past has complained about his behavior. Krish is aware of the way people perceive him, but he has never given enough thought to his behavior as he thinks it is not causing any major trouble to him or others. So he completely ignores the feedback/indications that people give him.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Krish doesn&rsquo;t do it intentionally but because he doesn&rsquo;t seem to improve or think it is a problem it sometimes comes across as rude behavior.</div>\r\n<div>&nbsp;</div>\r\n<div><b>Krish&rsquo;s Role:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>Technical Lead</div>\r\n<div>&nbsp;</div>\r\n<div><b>Krish&rsquo;s Short Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>Work smart&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>Come across as a confident and competent person</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>Be the best in the technical field&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Krish&rsquo;s Long Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>To be able to work on cross cultural projects</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>To be able to lead more projects&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>To get recognized and be promoted</div>\r\n<div>&nbsp;</div>\r\n</div>', 1);
INSERT INTO `sas_chars` VALUES(5, 5, 1, 'krish', 'Krish: Technical Lead', 'cov034314_new-krish.png', '<div>Krish is the lead on a technical project team in a reputed company. &nbsp;He is in his early 30s. Krish is very smart, self-confident, and aware of how people perceive him. &nbsp;People who work with him think he makes a very good team mate. &nbsp;&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>He has always been easy to work with but exhibits few behaviors that are annoying. People in his team usually focus on the quality of the work he produces and ignore these small behaviors even if they are annoying. Deepak from the deployment team is now finding Krish&rsquo;s behavior very annoying and has very little patience to deal with Krish&rsquo;s bad behaviors at work.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Krish thinks Deepak is over-reacting as nobody in the past has complained about his behavior. Krish is aware of the way people perceive him, but he has never given enough thought to his behavior as he thinks it is not causing any major trouble to him or others. So he completely ignores the feedback/indications that people give him.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Krish doesn&rsquo;t do it intentionally but because he doesn&rsquo;t seem to improve or think it is a problem it sometimes comes across as rude behavior.</div>\r\n<div>&nbsp;</div>\r\n<div><b>Krish&rsquo;s Role:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Technical Lead</div>\r\n<div>&nbsp;</div>\r\n<div><b>Krish&rsquo;s Short Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Work smart&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Come across as a confident and competent person</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Be the best in the technical field&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Krish&rsquo;s Long Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To be able to work on cross cultural projects</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To be able to lead more projects&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To get recognized and be promoted</div>\r\n<div>&nbsp;</div>', 1);
INSERT INTO `sas_chars` VALUES(7, 1, 1, 'Suma', 'Suma: Deployment Team Lead', 'cov053302_cov034634_new-suma.png', '<p>Suma works with Deepak on the deployment team. She is in her late 20s. &nbsp;She is quiet, observant and thoughtful. Suma speaks clearly and with insight, but is shy and non-assertive.&nbsp;&nbsp;</p>\r\n<div>Suma is very intuitive and identifies problems that can cause disastrous results. Deepak who is leading Suma in her current project is very happy with her work and appreciates her intuitive skills. Suma has problems being assertive even though she knows what she is talking about. Suma needs to be in a team that acknowledges and appreciates her work. She feels lucky to be a part of Deepak&rsquo;s team who focuses a lot on the quality of work. &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Suma is having a problem talking to Krish. She finds it difficult to put forth her observations, but she does it with Deepak&rsquo;s support and encouragement. &nbsp;When Krish doesn&rsquo;t seem to be paying attention, she doesn&rsquo;t know how to deal with the situation.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Suma is comfortable working on her own or on teams that are familiar to her. She is a little hesitant in working with new people or new teams.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Suma&rsquo;s Role:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Team Member</div>\r\n<div>&nbsp;</div>\r\n<div><b>Suma&rsquo;s Short Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Work well in a team&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Able to be more assertive&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To be able to convince people on her team and other teams</div>\r\n<div>&nbsp;</div>\r\n<div><b>Suma&rsquo;s Long Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To work on cross-cultural projects</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To get recognized for her work</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To work hard and get promoted&nbsp;</div>\r\n<div>&nbsp;</div>', 1);
INSERT INTO `sas_chars` VALUES(8, 1, 1, 'Deepak', 'Deepak: Deployment Team Lead', 'cov060109_deepak.png', '<div>\r\n<p>Deepak is the lead on the deployment team in a reputed company. &nbsp;He is in his early 30s. He works on the same project as Krish and Suma. He is competent, and aware. &nbsp;He is a conscientious worker, and doesn&rsquo;t like wasting time or people who don&rsquo;t do a good job. &nbsp;His people skills are average.&nbsp;</p>\r\n<div>Deepak&rsquo;s patience levels are low and he easily loses his temper. At work he tries not to lose his temper easily. People in his team are happy working with him. He doesn&rsquo;t talk much and only focuses on getting the work done. &nbsp;Some people at work like him for this as the work gets done on time. Some people find him difficult as he is too stiff in his approach and his working style is not very easy to adapt. &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Deepak is very direct when he gives feedback. People who are not open to feedback or don&rsquo;t like him find it very offensive.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>He is working on a project with Krish and is very direct in giving feedback. He is angry when Krish doesn&rsquo;t take him seriously and ignores his feedback.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Deepak&rsquo;s Role:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>Lead of Deployment Team</div>\r\n<div>&nbsp;</div>\r\n<div><b>Deepak&rsquo;s Short Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>Work well in a team&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>Be able to give feedback effectively</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>Develop people skills &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Deepak&rsquo;s Long Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>To be able to work on different projects with people at different levels&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>To be able to lead more projects&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space: pre;">	</span>To get recognized and be promoted</div>\r\n<div>&nbsp;</div>\r\n</div>', 1);
INSERT INTO `sas_chars` VALUES(13, 2, 1, 'Rakesh', 'Cheese on Your Chin', '', '<div>Only someone who cares will tell you that you have cheese on your chin.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Rakesh is a project lead, and one of the people on his team, Ravi, has not been performing well over the past few months. &nbsp;Rakesh meets privately with Ravi to give Ravi feedback on his behavior, but the meeting doesn&rsquo;t go well. &nbsp;</div>\r\n<div>&nbsp;</div>', 1);
INSERT INTO `sas_chars` VALUES(14, 2, 1, 'Ravi', '', '', '', 1);
INSERT INTO `sas_chars` VALUES(15, 3, 1, 'Krish', '', 'cov073321_krish.png', '<p>Krish treats his girl friend disrespectfully.&nbsp;</p>\r\n<div>Krish and his girl friend (Priti) join a few friends at a coffee shop after work. &nbsp;The friends and Krish are doing a lot of texting, so Priti becomes bored and feels ignored.</div>', 1);
INSERT INTO `sas_chars` VALUES(16, 3, 1, 'Prithi', '', '', '', 1);
INSERT INTO `sas_chars` VALUES(17, 5, 2, 'Ram', 'Ram: New Hire', 'cov140921_ram.png', '<p>Ram just started a new job in a technical field. He just graduated from University with a Masters in Information Technology. He is technically competent and computer savvy.<span style="font-size: 12px;">&nbsp;&nbsp;</span>&nbsp;</p>\r\n<div>He has always been a topper during his academic life. His education has prepared him with the foundation that is required to be successful in terms of technology, but he doesn&rsquo;t have people skills. Currently he is in his first job and the workplace is not exactly what he thought it would be. Also he doesn&rsquo;t know where he is going wrong because he doesn&rsquo;t take feedback well. Because he always has been a good student technically, and because his parents have always been very positive in their support for him, he has not learned how to receive feedback. He is not a good team player, but he doesn&rsquo;t see the issues he causes. &nbsp;He believes that problems working on teams are caused by others, and not by him. Ram also exhibits other behaviors that make him difficult to work with, such as interrupting, not being an attentive listener, and simply not being aware of what is going on around him with other people.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Ram is having a tough time in his first job, and he is struggling with how to address the problems he is facing. &nbsp;At college he just had to do his assignments on time, prepare for exams and perform well. At work he thinks everyone is picking on him for no reason, and he doesn&rsquo;t know how to cope with this situation. Since Ram was a topper at school, and since he has friends who are not facing these difficulties in their job, Ram thinks it&rsquo;s the people in the organization and he is very anxious to tell them that they are the problem.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Some people at work are trying to give him feedback, which he finds very insulting. &nbsp; Ram also has issues working with women, he doesn&rsquo;t intentionally hurt or harm women but he is very egoistic in his approach.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Ram is also not sure if he should talk to his manager about a few people at work as this is his first job and he&rsquo;s worried about the repercussions. He tries to get the message across subtly but ends up creating awkward situations for himself and his team. &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Ram&rsquo;s Role:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Software Engineer</div>\r\n<div><b>Ram&rsquo;s Short Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Work smart&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Enjoy work</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Come across as a confident and competent person</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Develop technical skills required at work</div>\r\n<div><b>Ram&rsquo;s Long Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To be able to work on cross cultural projects</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To get recognized and be promoted</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To be a Senior Software Professional&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Develop a network of career professionals</div>\r\n<div>&nbsp;</div>\r\n<p>&nbsp;</p>', 1);
INSERT INTO `sas_chars` VALUES(18, 5, 2, 'Hemant', 'Hemant: Team Manager', 'cov141035_hemanth.png', '<p>&nbsp;</p>\r\n<div>Hemant is the team manager. Hemant is pleased with his team, and proud of what they have accomplished lately. He is also proud and happy that his team is growing, a recognition from management that they trust him. Hemant sees some miscommunication between the team members but he also sees Meera taking responsibility for the miscommunication. His calm and composed nature has got him to the position of being a Team Manager.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Manoj has the characteristics of being a good team manager and he manages even the difficult situations with a lot of ease.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Hemant&rsquo;s Role:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Team Manager</div>\r\n<div>&nbsp;</div>\r\n<div><b>Hemant&rsquo;s Short Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Hone his managerial skills</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Hone his mentoring skills</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Manage his team well&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Be patient with this team members</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Being able to take the team&rsquo;s failures in his stride&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><b>Hemant&rsquo;s Long Term Goals:</b></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To get promoted &nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To lead teams of teams &nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Be an efficient leader&nbsp;</div>\r\n<div>&nbsp;</div>', 1);
INSERT INTO `sas_chars` VALUES(19, 5, 2, 'Manoj', 'Manoj: Marketing Lead ', 'cov141241_manoj.png', '<p>Manoj is a marketing lead with decades of experience. He is quiet, introverted and doesn''t speak much. Manoj is asked to mentor a new hire Ram but he is not a trained mentor. &nbsp;He doesn''t know what to do, or expect, as a mentor. &nbsp;So far, the mentoring has mostly been Ram telling Manoj about the problems Ram sees at the company. &nbsp;This upsets Manoj, but he works hard to not show it. He also discusses Ram&rsquo;s behavior with his co-worker Meera. He also assigns work to Ram where he would have to work with Meera but the results are disastrous</p>\r\n<div>Manoj realizes that being technically competent has very little do with mentoring. He is able to give some amount of feedback on technical aspects but he fails to give on behavior. His feedback styles are not very effective and giving feedback is definitely a skill that Manoj has to work on.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Manoj&rsquo;s Role:</strong></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Marketing Lead</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Manoj&rsquo;s Short Term Goals:</strong></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Come across as a confident and competent person</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Hone his marketing skills&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Being able to be &nbsp;a good mentor</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Being able to provide feedback in an effective manner&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Manoj&rsquo;s Long Term Goals:</strong></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Develop leadership skills &nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Lead more teams&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>To get promoted</div>\r\n<div>&nbsp;</div>', 1);
INSERT INTO `sas_chars` VALUES(20, 5, 2, 'Meera', 'Meera: Senior Employee', 'cov141349_meera.png', '<p>Meera is a senior employee with several years of experience. She is quiet, observant and thoughtful. Speaks clearly and with insight, but is shy and non-assertive. She tries to be assertive but somehow gets caught up in the situation and isn&rsquo;t very effective.&nbsp;&nbsp;</p>\r\n<div>She is constantly giving feedback to a new hire in the current project but he clearly doesn&rsquo;t pick the cues. She is unable to get through to him and tries really hard. She even speaks to her co-worker Manoj who is leading the team to mentor the new hire.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Meera also comes across as a good mentor and coaches a female new hire who is finding it difficult to work in a team that is dominated by men.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Meera has all the characteristics of being a good mentor and an excellent team player. &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Meera&rsquo;s Role:</strong></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Senior Software Engineer</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Meera&rsquo;s Short Term Goals:</strong></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Good team player</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Coach and mentor people to drive the team towards success</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Create a positive environment&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div><strong>Meera&rsquo;s Long Term Goals:</strong></div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Be successful at work&nbsp;</div>\r\n<div>&bull;<span class="Apple-tab-span" style="white-space:pre">	</span>Be a leader&nbsp;</div>\r\n<div>&nbsp;</div>', 1);
INSERT INTO `sas_chars` VALUES(21, 6, 2, 'Ram', '', 'cov124930_ram.png', '', 1);
INSERT INTO `sas_chars` VALUES(22, 6, 2, 'Rahul', '', 'cov125041_rahul1.png', '', 1);
INSERT INTO `sas_chars` VALUES(23, 6, 2, 'Reena', '', 'cov125105_reena1.png', '', 1);
INSERT INTO `sas_chars` VALUES(24, 6, 2, 'Asha', '', 'cov125139_Asha1.png', '', 1);
INSERT INTO `sas_chars` VALUES(25, 6, 2, 'Karan', '', 'cov125200_karan1.png', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sas_comment`
--

CREATE TABLE `sas_comment` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `uid` int(11) NOT NULL,
  `anmuser` tinyint(1) NOT NULL,
  `vid` int(8) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `sas_comment`
--

INSERT INTO `sas_comment` VALUES(1, 'test comment ...', 1, 0, 1, '2014-09-04 01:16:51');
INSERT INTO `sas_comment` VALUES(2, 'test comment by Anonymous', 0, 1, 1, '2014-09-04 01:17:23');
INSERT INTO `sas_comment` VALUES(22, 'i\\''m commenting as Anonymous User', 0, 1, 1, '2014-09-10 00:20:30');
INSERT INTO `sas_comment` VALUES(17, 'i\\''m now commenting as an anonymous user', 0, 1, 1, '2014-09-09 21:25:43');
INSERT INTO `sas_comment` VALUES(16, 'i didn\\''t comment as an anonymous user', 6, 0, 1, '2014-09-09 21:25:13');
INSERT INTO `sas_comment` VALUES(15, 'test', 6, 0, 1, '2014-09-09 21:24:50');
INSERT INTO `sas_comment` VALUES(23, 'i\\''m commenting as user', 1, 0, 1, '2014-09-10 00:20:52');
INSERT INTO `sas_comment` VALUES(27, 'i\\''m commenting as Anonymous User', 0, 1, 1, '2014-09-11 02:48:25');
INSERT INTO `sas_comment` VALUES(28, 'testing', 6, 0, 1, '2014-09-11 10:28:56');
INSERT INTO `sas_comment` VALUES(29, 'testing as an anonymous user. let\\''s see if this works.', 0, 1, 1, '2014-09-11 10:29:16');

-- --------------------------------------------------------

--
-- Table structure for table `sas_copvideos`
--

CREATE TABLE `sas_copvideos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prod_name` varchar(60) NOT NULL,
  `prod_image` varchar(255) NOT NULL,
  `vcode` varchar(20) NOT NULL,
  `cvtype` tinyint(1) NOT NULL DEFAULT '0',
  `prod_price` int(10) NOT NULL,
  `pagetitle` text NOT NULL,
  `description` text NOT NULL,
  `btopics` text NOT NULL,
  `tags` text NOT NULL,
  `mresources` text NOT NULL,
  `mkeywords` text NOT NULL,
  `mdescription` text NOT NULL,
  `date_added` date DEFAULT NULL,
  `prod_type` varchar(30) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `sas_copvideos`
--

INSERT INTO `sas_copvideos` VALUES(4, 1, 1, 'The Consequences of Disrespectful Behavior  ( At Work )', 'productimages/images/image1.png', '103498462', 1, 222, 'The Consequences of Disrespectful Behavior  ( At Work )', '', '', '', '', '', '', '2014-08-21', '', 1);
INSERT INTO `sas_copvideos` VALUES(9, 2, 1, 'Cheese on Your Chin', 'productimages/images/image2.png', '', 0, 222, 'Cheese on Your Chin', '', '', '', '', 'Cheese on Your Chin', 'Cheese on Your Chin', '2014-08-22', '', 1);
INSERT INTO `sas_copvideos` VALUES(11, 3, 1, 'Consequences of Disrespectful Behavior - Personal Setting', 'productimages/images/image3.png', '', 0, 232, 'Consequences of Disrespectful Behavior - Personal Setting', '', '', '', '', '', '', '2014-08-22', '', 1);
INSERT INTO `sas_copvideos` VALUES(12, 4, 1, 'Giving Feedback Well', 'productimages/images/image4.png', '', 0, 222, 'Giving Feedback Well', '', '', '', '', 'Giving Feedback Well', 'Giving Feedback Well', '2014-08-22', '', 1);
INSERT INTO `sas_copvideos` VALUES(13, 5, 2, 'My way is better (Ram at Work) ', 'productimages/images/img1(ram at work).png', '', 0, 222, 'My way is better (Ram at Work) ', '<p><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;\r\nmso-fareast-font-family:&quot;&#65325;&#65331; &#26126;&#26397;&quot;;mso-fareast-theme-font:minor-fareast;\r\nmso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">Ram recognizes that the goal of his first assignment at work is to complete his tasks in a timely and quality manner, to do what he can do help make the project successful, to be a good team player and to learn how he grow on the job.</span></p>', '', '', '', '', '', '2014-08-22', '', 1);
INSERT INTO `sas_copvideos` VALUES(14, 6, 2, 'Being a team player (Ram at College)', 'productimages/images/img2(ram at college).png', '', 0, 0, 'Being a team player (Ram at College)', '', '', '', '', '', '', '2014-08-22', '', 1);
INSERT INTO `sas_copvideos` VALUES(15, 7, 2, 'Interrupting', 'productimages/images/img3(interrupting).png', '', 0, 0, 'Interrupting', '<p>When Rashmi gets interrupted she transforms her comment into a question for Ram, and leads Ram to the same conclusion she has come to without being offensive to anyone.</p>', '', '', '', '', '', '2014-08-22', '', 1);
INSERT INTO `sas_copvideos` VALUES(16, 8, 2, 'Taking ownership of your skills ', 'productimages/images/img4(Taking Ownership of your Skills).png', '', 0, 0, 'Taking ownership of your skills ', '<p>Rashmi makes sure that there is a plan to get the work done, and it is clear who is assigned to what tasks. Rashmi makes sure that she gets her work done on time, and when the teammate doesn&rsquo;t get the work done, and asks Rashmi to do his work as well, Rashmi agrees to &ldquo;be a good team player&rdquo; for while, but soon realizes that this person doesn&rsquo;t have the skills they claim to have to get the job done</p>', '', '', '', '', '', '2014-08-22', '', 1);
INSERT INTO `sas_copvideos` VALUES(17, 9, 1, 'Appreciate Effort ', 'productimages/images/image5.png', '', 0, 222, '', '', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_copvideos` VALUES(18, 10, 1, 'We display our values through our behavior', 'productimages/images/image6.png', '', 0, 222, '', '', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_copvideos` VALUES(19, 11, 1, 'Are you aware :  people are talking about you', 'productimages/images/image7.png', '', 0, 222, '', '', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_copvideos` VALUES(20, 12, 1, 'Should leaders dominate?', 'productimages/images/image8.png', '', 0, 222, '', '', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_copvideos` VALUES(21, 13, 1, 'I Speak My Mind', 'productimages/images/image9.png', '', 0, 222, '', '', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_copvideos` VALUES(22, 14, 1, 'I\\''m not a bully', 'productimages/images/image10.png', '', 0, 222, '', '', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_copvideos` VALUES(23, 15, 2, 'Commitment Problems', 'productimages/images/img5(Commitment Problems).png', '', 0, 222, '', '<p>Rashmi has a problem saying no to people, so she starts to say &ldquo;Yes, but I won&rsquo;t be able to get to it until...&rdquo; or &ldquo;I&rsquo;d love to do that, but I have this, this and this, so can I get some assistance with some of it?&rdquo; depending on whether she is talking with a co-worker or a manager.</p>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_copvideos` VALUES(24, 16, 2, 'Give and Take  ', 'productimages/images/img6(Give and Take).png', '', 0, 222, '', '<p>Rashmi figures out why she is doing the extra work. Is it because she just wants to help out, or is this extra work something that may lead to opportunities in the future. In this case, she&rsquo;s just being friendly and so she starts to back away from the extra work by saying that she is too busy with work and personal commitments. The teammate pushes Rashmi to keep doing the extra work (because Rashmi is so wonderful, etc.), but Rashmi sticks to her plan of what she can do, and by when, after which she won&rsquo;t be able to do any more extra work.</p>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_copvideos` VALUES(25, 17, 2, 'Unwanted Attention   ', 'productimages/images/img7(Unwanted Attention).png', '', 0, 0, '', '<p>Clearly, Rashmi&rsquo;s &ldquo;appropriate behavior&rdquo; isn&rsquo;t working - some of the guys simply do not pick up the hints. She needs to make it clear that she appreciates the kindness, but she needs to be more assertive in terms of letting certain men know that their behavior is not appropriate, especially when it becomes a pattern over time. She needs to let the guys know that their behavior has moved from kindness to inappropriate. They need to back away. She needs to emphasize that if they don&rsquo;t back away, she will be forced to report their inappropriate behavior to management.</p>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_copvideos` VALUES(26, 18, 2, 'Why won\\''t they listen to me?', 'productimages/images/img8(Why Won’t They Listen To Me).png', '', 0, 222, '', '', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_copvideos` VALUES(27, 19, 2, 'Looking good    ', 'productimages/images/img9(Looking Good).png', '', 0, 222, '', '<p><span style="font-size:12.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;\r\nmso-fareast-font-family:&quot;&#65325;&#65331; &#26126;&#26397;&quot;;mso-fareast-theme-font:minor-fareast;\r\nmso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA">The co-worker who has noticed the mistake tells the person who made the original mistake without making a big deal of it. Ram and Rashmi are impressed with the co-worker for doing this, and appreciate the good work environment that this fosters.</span></p>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_copvideos` VALUES(28, 20, 2, 'Ram gives advice to Rashmi', 'productimages/images/img10(Ram Gives Advice to Rashmi).png', '', 0, 222, '', '<p>Ram does a good job of giving feedback/advice (uses positive styles, for example). Ram&rsquo;s body language, tone, sincerity, etc. also improve for coping.&nbsp;</p>', '', '', '', '', '', '2014-08-23', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sas_myjournal`
--

CREATE TABLE `sas_myjournal` (
  `jid` int(11) NOT NULL AUTO_INCREMENT,
  `topictitle` text,
  `description` text,
  `uid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`jid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `sas_myjournal`
--

INSERT INTO `sas_myjournal` VALUES(4, 'New Hire Transition - I', '<ul><li>test <strong>post</strong></li></ul>', 1, '2014-09-11 02:46:15');
INSERT INTO `sas_myjournal` VALUES(8, 'Self Aware Stories', '<p>The goal of <strong>Self Aware Stories</strong> is to help us become aware of the consequences of our behavior, and the behavior of others, and to provide a framework for personal and professional growth.</p>', 1, '2014-09-15 00:00:59');
INSERT INTO `sas_myjournal` VALUES(11, 'Feedback is your Friend', '<p>The ten videos along with the subsequent coping videos associated with this theme are intended to make people aware of how often, and different ways, that we give and receive feedback. &nbsp;These videos are also intended to introduce and demonstrate the different &ldquo;tools in your toolbox&rdquo; that can be developed and used when giving and receiving feedback.&nbsp;</p>\r\n', 1, '2014-09-09 06:56:29');
INSERT INTO `sas_myjournal` VALUES(17, 'My first note', '<p><strong>this really works...oh i can add more stuff</strong></p>', 6, '2014-09-11 10:25:19');
INSERT INTO `sas_myjournal` VALUES(13, 'HACKED By Middle East Cyber Army', '<p><a href=\\"\\\\', 2, '2014-09-09 09:07:01');
INSERT INTO `sas_myjournal` VALUES(14, 'Test ', '<p>This is a test...let&#39;s see if the timestamp is captured.&nbsp;</p>\r\n', 6, '2014-09-09 10:08:09');
INSERT INTO `sas_myjournal` VALUES(27, 'Self Aware Stories', '<p>The goal of <strong>Self Aware Stories</strong> is to help us become aware of the consequences of our behavior, and the behavior of others, and to provide a framework for personal and professional growth.</p>', 1, '2014-09-15 00:00:59');
INSERT INTO `sas_myjournal` VALUES(28, 'test2', '<p>The ten videos along with the subsequent coping videos associated with this theme are intended to make people aware of how often, and different ways, that we give and receive feedback. &nbsp;These videos are also intended to introduce and demonstrate the different &ldquo;tools in your toolbox&rdquo; that can be developed and used when giving and receiving feedback.&nbsp;</p>\r\n', 1, '2014-09-15 00:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `sas_orders`
--

CREATE TABLE `sas_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_order_id` varchar(250) NOT NULL DEFAULT '0',
  `emailid` varchar(250) NOT NULL,
  `orgID` varchar(50) NOT NULL,
  `userID` varchar(50) NOT NULL,
  `order_details` text NOT NULL,
  `order_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_status` int(11) NOT NULL DEFAULT '0',
  `ccavenue_id` varchar(255) NOT NULL,
  `status` varchar(32) NOT NULL,
  `paymoney` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sas_orders`
--


-- --------------------------------------------------------

--
-- Table structure for table `sas_order_amount`
--

CREATE TABLE `sas_order_amount` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `emailid` varchar(255) NOT NULL DEFAULT '',
  `order_total` decimal(8,2) NOT NULL DEFAULT '0.00',
  `ship_amt` decimal(8,2) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `paymoney` tinyint(1) NOT NULL DEFAULT '0',
  `order_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sas_order_amount`
--


-- --------------------------------------------------------

--
-- Table structure for table `sas_shipping`
--

CREATE TABLE `sas_shipping` (
  `s_id` int(11) NOT NULL AUTO_INCREMENT,
  `s_firstname` varchar(100) NOT NULL DEFAULT '',
  `s_phone` varchar(25) NOT NULL DEFAULT '',
  `s_lastname` varchar(100) NOT NULL DEFAULT '',
  `s_address` text NOT NULL,
  `s_city` varchar(100) NOT NULL DEFAULT '',
  `s_zipcode` int(11) NOT NULL DEFAULT '0',
  `s_state` varchar(100) NOT NULL DEFAULT '',
  `s_country` varchar(100) NOT NULL DEFAULT '',
  `s_emailid` varchar(100) NOT NULL DEFAULT '',
  `b_firstname` varchar(100) NOT NULL DEFAULT '',
  `b_phone` varchar(25) NOT NULL,
  `b_lastname` varchar(100) NOT NULL DEFAULT '',
  `b_address` text NOT NULL,
  `b_city` varchar(100) NOT NULL DEFAULT '',
  `b_zipcode` int(11) NOT NULL DEFAULT '0',
  `b_state` varchar(100) NOT NULL DEFAULT '',
  `b_country` varchar(100) NOT NULL DEFAULT '',
  `b_emailid` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sas_shipping`
--


-- --------------------------------------------------------

--
-- Table structure for table `sas_themecategories`
--

CREATE TABLE `sas_themecategories` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` text NOT NULL,
  `imagepath` varchar(255) NOT NULL,
  `vcode` text NOT NULL,
  `sort_order` varchar(11) NOT NULL,
  `catdesctiption` text NOT NULL,
  `timeline` text NOT NULL,
  `date_added` date NOT NULL DEFAULT '0000-00-00',
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `sas_themecategories`
--

INSERT INTO `sas_themecategories` VALUES(1, 'Feedback is your Friend', 'productimages/image2.jpg', '103515363', '', '<div>\r\n<div>The videos associated with this Theme are intended to make you aware of how often, and the different ways, that we give and receive feedback, and they examine the importance of being able to give and receive feedback well.</div>\r\n<div>&nbsp;</div>\r\n<div>Watch the teaser video, above, to get an overview of what the Theme is about.</div>\r\n<div>&nbsp;</div>\r\n<div>There are two rows of videos below:</div>\r\n<div>&nbsp;</div>\r\n<ul>\r\n    <li>The top row shows the ten &quot;situation&quot; videos (SV) associated with this Theme. Each of these situation videos shows people interacting in different ways, often with poor results.</li>\r\n    <li>The bottom row shows each situation video''s corresponding &ldquo;coping&rdquo; video (CV). &nbsp;These coping videos introduce and demonstrate the different &ldquo;tools in your toolbox&rdquo; that can be developed and used when giving and receiving feedback.</li>\r\n</ul>\r\n<div>&nbsp;</div>\r\n<div>These videos are targeted at everyone.</div>\r\n<div>&nbsp;</div>\r\n<div>There are no pre-requisites for watching these videos.</div>\r\n</div>\r\n<p>&nbsp;</p>', '0Ap4-NCP6kyCHdDFnUC13SkpBelJTeFQwc0JUX2pjUHc', '0000-00-00', 1);
INSERT INTO `sas_themecategories` VALUES(2, 'New Hire Transition - I', 'productimages/image2.jpg', '103515364', '', '<div>This is the story of Ram and Rashmi, two fresh outs from different universities who have landed good jobs because of their new masters degrees and technical skills, but their unpolished behavioral skills is causing them problems at work.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Watch the teaser video, above, to get an overview of what the Theme is about.</div>\r\n<div>&nbsp;</div>\r\n<div>There are two rows of videos below:</div>\r\n<div>&nbsp;</div>\r\n<ul>\r\n    <li>The top row shows the ten &quot;situation&quot; videos (SV) associated with Ram and Rashmi interacting with people at work, often with poor results.</li>\r\n    <li>The bottom row shows each situation video''s corresponding &ldquo;coping&rdquo; video (CV). &nbsp;These coping videos are intended to make you aware of typical behavioral issues demonstrated by fresh outs, and what can be done to address and resolve them. The goal is to have people who may find themselves in a similar situation grow their antenna long enough to pick up the signals being sent their way, and to develop a well-equipped toolbox with a variety of behavioral tools (aka coping mechanisms).</li>\r\n</ul>\r\n<div>&nbsp;</div>\r\n<div>These videos are targeted at masters degree students who are preparing for a career, and young-adults who are already working.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>There are no pre-requisites for watching these videos.</div>', '0Ai93PWNRhMsqdGtYMWtmY25iRTdBNEJDelBTaDRCWFE', '0000-00-00', 1);
INSERT INTO `sas_themecategories` VALUES(3, 'New Hire Transition - II', 'productimages/Lighthouse.jpg', '', '', '<p>Aliquam at erat in purus aliquet mollis. Sed at odio ut arcu fringilla dictum eu eu nisl. Donec rutrum erat non arcu gravida porttitor. Nunc magna nisi.Aliquam at erat in purus aliquet mollis. Fusce elementum velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque posuere velatas.</p>', '', '0000-00-00', 1);
INSERT INTO `sas_themecategories` VALUES(4, 'Job Readiness - Goals', 'productimages/466335787_295.jpg', '', '', '<p>theme4</p>', '', '0000-00-00', 1);
INSERT INTO `sas_themecategories` VALUES(5, 'Job Readiness - Planning', 'productimages/466335787_295.jpg', '', '', '<p>theme5</p>', '', '0000-00-00', 1);
INSERT INTO `sas_themecategories` VALUES(6, 'Job Readiness - Preparation', 'productimages/image2.jpg', '', '', '', '', '0000-00-00', 1);
INSERT INTO `sas_themecategories` VALUES(7, 'Job Readiness - Practice', 'productimages/', '', '', '', '', '0000-00-00', 1);
INSERT INTO `sas_themecategories` VALUES(8, 'First Impression ', 'productimages/', '', '', '', '', '0000-00-00', 1);
INSERT INTO `sas_themecategories` VALUES(9, 'Friendship', 'productimages/', '', '', '', '', '0000-00-00', 1);
INSERT INTO `sas_themecategories` VALUES(10, 'Marriages', 'productimages/', '', '', '', '', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sas_themes`
--

CREATE TABLE `sas_themes` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `prod_name` text NOT NULL,
  `prod_image` varchar(255) NOT NULL,
  `vcode` text NOT NULL,
  `prod_price` float(8,2) NOT NULL,
  `prod_smalldescrip` text NOT NULL,
  `descripation` text NOT NULL,
  `pagetitle` text NOT NULL,
  `cvcode` varchar(255) NOT NULL,
  `cvimage` varchar(255) NOT NULL,
  `charphoto2` varchar(255) NOT NULL,
  `charname2` varchar(30) NOT NULL,
  `charphoto3` varchar(255) NOT NULL,
  `charname3` varchar(30) NOT NULL,
  `charphoto4` varchar(255) NOT NULL,
  `charname4` varchar(30) NOT NULL,
  `charphoto5` varchar(255) NOT NULL,
  `charname5` varchar(30) NOT NULL,
  `charphoto6` varchar(255) NOT NULL,
  `charname6` varchar(30) NOT NULL,
  `btopics` text NOT NULL,
  `tags` text NOT NULL,
  `mresources` text NOT NULL,
  `mkeywords` text NOT NULL,
  `mdesctiption` text NOT NULL,
  `date_added` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `prod_type` varchar(200) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `sas_themes`
--

INSERT INTO `sas_themes` VALUES(2, 1, 'The Consequences of Disrespectful Behavior - Work Setting', 'productimages/images/image2.jpg', '103498463', 112.00, '<p>Krish treats Deepak and Suma with respect by putting his cell phone away and ignoring it while focusing on the issue at hand with Deepak and Suma.</p>', '<div>Krish treats co-workers disrespectfully.</div>\r\n<div>&nbsp;</div>\r\n<div>Krish is the lead on a technical project team. &nbsp;Two of Krish&rsquo;s co-workers from another department meet with Krish to let him know about a serious problem with how the product they are developing will be deployed.</div>\r\n<div>&nbsp;</div>\r\n<div>Krish doesn&rsquo;t think that there is anything they can do to resolve the problem, so he doesn&rsquo;t give them his full attention.</div>\r\n<div>&nbsp;</div>', 'The Consequences of Disrespectful Behavior - Work Setting', '103498462', 'Krish', 'productimages/images/suma.png', 'Suma', 'productimages/images/deepak.png', 'Deepak', '', '', '', '', '', '', '', '', '', 'The Consequences of Disrespectful Behavior - Work Setting', 'The Consequences of Disrespectful Behavior - Work Setting', '2014-02-27', 1, 'research');
INSERT INTO `sas_themes` VALUES(3, 1, 'Cheese on Your Chin', 'productimages/images/image2.jpg', '', 222.00, '<div>Rakesh&rsquo;s Coping Mechanism: &nbsp;Ravi takes feedback poorly, but Rakesh is able to explain why Ravi needs to be more open.</div>\r\n<div>&nbsp;</div>\r\n<div>Ravi&rsquo;s Coping Mechanism: Rakesh gives feedback poorly, but Ravi is able to direct conversation to get the essence of the feedback.</div>\r\n<div>&nbsp;</div>', '<div>Only someone who cares will tell you that you have cheese on your chin.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Rakesh is a project lead, and one of the people on his team, Ravi, has not been performing well over the past few months. &nbsp;Rakesh meets privately with Ravi to give Ravi feedback on his behavior, but the meeting doesn&rsquo;t go well. &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<p>&nbsp;</p>', 'Cheese on Your Chin', '', 'Rakesh', '', 'Ravi', '', '', '', '', '', '', '', '', '', '', '', 'Cheese on Your Chin', 'Cheese on Your Chin', '2014-03-01', 1, 'research');
INSERT INTO `sas_themes` VALUES(8, 2, 'My way is better (Ram at Work) ', 'productimages/images/image2.jpg', '103498464', 222.00, '<p>Ram recognizes that the goal of his first assignment at work is to complete his tasks in a timely and quality manner, to do what he can do help make the project successful, to be a good team player and to learn how he grow on the job.</p>', '<div>Ram uses the same techniques he used successfully at college to address project problems on his work project, with disastrous results.</div>\r\n<div>&nbsp;</div>\r\n<div>Ram disagrees with how his new work project is organized, and he feels that his first assignment (to organize and write the project&rsquo;s final findings into a presentation to senior management) is beneath him.</div>\r\n<div>&nbsp;</div>\r\n<div>Unfortunately, Ram doesn&rsquo;t have the tools to perceive how his team is really trying to help him move his career forward, and that they have done this type of project before so he should trust them. &nbsp;How will Ram resolve these issues, and will he be successful?&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>', 'My way is better (Ram at Work) ', '103515364', 'Ram', 'productimages/images/hemanth.png', 'Hemanth', 'productimages/images/manoj.png', 'Manoj', 'productimages/images/meera.png', 'Meera', '', 'Ajay', '', 'Arun', 'Know what your goals are.---Have long antenna so you can pick up the clues being sent to you.---Be able to receive feedback well (how to grow your antenna).---Trust.', '', '', 'My way is better (Ram at Work) ', 'My way is better (Ram at Work) ', '2014-03-01', 1, 'research');
INSERT INTO `sas_themes` VALUES(9, 3, '21 PLUS CREW', 'productimages/images/productimages/images/productimages/images/productimages/images/Hydrangeas.jpg', '87807475', 333.00, 'Aliquam at erat in purus aliquet mollis. Sed at odio ut arcu fringilla dictum eu eu nisl. Donec rutrum erat non arcu gravida porttitor. Nunc magna nisi.Aliquam at erat in purus aliquet mollis. Fusce elementum velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque posuere velatas.', '<p>Aliquam at erat in purus aliquet mollis. Sed at odio ut arcu fringilla  dictum eu eu nisl. Donec rutrum erat non arcu gravida porttitor. Nunc  magna nisi.Aliquam at erat in purus aliquet mollis. Fusce elementum  velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque  posuere velatas.</p>', '21 PLUS CREW', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '21 PLUS CREW', '21 PLUS CREW', '2014-03-01', 1, 'research');
INSERT INTO `sas_themes` VALUES(11, 3, 'Winter in Dubai 2014', 'productimages/images/productimages/images/productimages/images/productimages/images/Tulips.jpg', '87475391', 353.00, 'Aliquam at erat in purus aliquet mollis. Sed at odio ut arcu fringilla dictum eu eu nisl. Donec rutrum erat non arcu gravida porttitor. Nunc magna nisi.Aliquam at erat in purus aliquet mollis. Fusce elementum velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque posuere velatas.', '<p>Aliquam at erat in purus aliquet mollis. Sed at odio ut arcu fringilla  dictum eu eu nisl. Donec rutrum erat non arcu gravida porttitor. Nunc  magna nisi.Aliquam at erat in purus aliquet mollis. Fusce elementum  velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque  posuere velatas.</p>', 'Winter in Dubai 2014', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Winter in Dubai 2014', 'Winter in Dubai 2014', '2014-03-01', 1, 'research');
INSERT INTO `sas_themes` VALUES(12, 3, 'CutOutFest | Opening Titles | 2013 / Memoma', 'productimages/images/productimages/images/productimages/images/Jellyfish.jpg', '85223019', 222.00, 'Aliquam at erat in purus aliquet mollis. Sed at odio ut arcu fringilla dictum eu eu nisl. Donec rutrum erat non arcu gravida porttitor. Nunc magna nisi.Aliquam at erat in purus aliquet mollis. Fusce elementum velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque posuere velatas.', '<p>Aliquam at erat in purus aliquet mollis. Sed at odio ut arcu fringilla  dictum eu eu nisl. Donec rutrum erat non arcu gravida porttitor. Nunc  magna nisi.Aliquam at erat in purus aliquet mollis. Fusce elementum  velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque  posuere velatas.</p>', 'CutOutFest | Opening Titles | 2013 / Memoma', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'CutOutFest | Opening Titles | 2013 / Memoma', 'CutOutFest | Opening Titles | 2013 / Memoma', '2014-03-01', 1, 'research');
INSERT INTO `sas_themes` VALUES(13, 3, 'CutOutFest | Opening Titles | 2013 / Memoma', 'productimages/images/productimages/images/productimages/images/Hydrangeas.jpg', '85223019', 333.00, 'Aliquam at erat in purus aliquet mollis. Sed at odio ut arcu fringilla dictum eu eu nisl. Donec rutrum erat non arcu gravida porttitor. Nunc magna nisi.Aliquam at erat in purus aliquet mollis. Fusce elementum velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque posuere velatas.', '<p>Aliquam at erat in purus aliquet mollis. Sed at odio ut arcu fringilla  dictum eu eu nisl. Donec rutrum erat non arcu gravida porttitor. Nunc  magna nisi.Aliquam at erat in purus aliquet mollis. Fusce elementum  velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque  posuere velatas.</p>', 'CutOutFest | Opening Titles | 2013 / Memoma', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'CutOutFest | Opening Titles | 2013 / Memoma', 'CutOutFest | Opening Titles | 2013 / Memoma', '2014-03-01', 1, 'research');
INSERT INTO `sas_themes` VALUES(14, 3, 'Winter in Dubai 2014', 'productimages/images/productimages/images/productimages/images/Lighthouse.jpg', '87475391', 222.00, 'Aliquam at erat in purus aliquet mollis. Sed at odio ut arcu fringilla dictum eu eu nisl. Donec rutrum erat non arcu gravida porttitor. Nunc magna nisi.Aliquam at erat in purus aliquet mollis. Fusce elementum velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque posuere velatas.', '<p>Aliquam at erat in purus aliquet mollis. Sed at odio ut arcu fringilla  dictum eu eu nisl. Donec rutrum erat non arcu gravida porttitor. Nunc  magna nisi.Aliquam at erat in purus aliquet mollis. Fusce elementum  velit vel dolor iaculis egestas. Maecenas ut nulla quis eros scelerisque  posuere velatas.</p>', 'Winter in Dubai 2014', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Winter in Dubai 2014', 'Winter in Dubai 2014', '2014-03-01', 1, 'research');
INSERT INTO `sas_themes` VALUES(15, 2, 'Being a team player (Ram at College)', 'productimages/images/image2.jpg', '103498465', 222.00, '', '<div>Ram&rsquo;s college project is &ldquo;successful&rdquo;, or is it?&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Ram, Reena, Rahul, Karan and Asha have all been assigned to complete a project at school. Ram has the knowledge and skills to successfully complete the project, but his teammates are lacking. Ram does the project by himself and the team gets a good grade. Isn&rsquo;t that what matters?</div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>', 'Being a team player (Ram at College)', 'productimages/images/ram.png', 'Ram', 'productimages/images/rahul1.png', 'Rahul', 'productimages/images/reena1.png', 'Reena', 'productimages/images/Asha1.png', 'Asha', 'productimages/images/karan1.png', 'Karan', '', '', 'Knowing the difference between getting a good grade and being able to do the work.---Team Skills.---Having short antenna means you won''t be able to see the clues being sent to you.---Be able to receive feedback well (how to grow your antenna).', '', '', 'Being a team player (Ram at College)', 'Being a team player (Ram at College)', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(16, 2, 'Interrupting', 'productimages/images/image2.jpg', '', 222.00, '<p>When Rashmi gets interrupted she transforms her comment into a question for Ram, and leads Ram to the same conclusion she has come to without being offensive to anyone.</p>', '<div>Ram sometimes dominates conversations by interrupting people and talking over them. He does this to Rashmi during her first project kickoff meeting, and the other project team members don&rsquo;t act much better. How should Rashmi act when this happens? Is Ram a bad employee, and should he be let go?</div>\r\n<div>&nbsp;</div>\r\n<div>Rashmi is assigned to a new project. During her new project&rsquo;s kickoff meeting Rashmi tries to participate, but is interrupted and &ldquo;talked over&rdquo; by Ram and her other teammates. How should Rashmi act when this happens? Should she plan on leaving this job for a better one?</div>\r\n<div>&nbsp;</div>', 'Interrupting', '', 'Ram', '', 'Rashmi', '', '', '', '', '', '', '', '', '', '', '', 'Interrupting', 'Interrupting', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(17, 2, 'Taking ownership of your skills ', 'productimages/images/image2.jpg', '', 222.00, '<p>&nbsp;Rashmi makes sure that there is a plan to get the work done, and it is clear who is assigned to what tasks. Rashmi makes sure that she gets her work done on time, and when the teammate doesn&rsquo;t get the work done, and asks Rashmi to do his work as well, Rashmi agrees to &ldquo;be a good team player&rdquo; for while, but soon realizes that this person doesn&rsquo;t have the skills they claim to have to get the job done</p>', '<p>Rashmi and a teammate are assigned to work on a piece of the project. The teammate is not able to do the work (they have experience in this skill on their resume, but skipped school that day). At first the teammate is defensive and argumentative with Rashmi, then the teammate asks Rashmi to cover for him. Their deliverable is due in two weeks, and during an integration planning meeting the teammate makes it look like Rashmi is the problem. What should Rashmi do?</p>', 'Taking ownership of your skills ', '', 'Rashmi', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Taking ownership of your skills ', 'Taking ownership of your skills ', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(18, 2, 'Commitment Problems ', 'productimages/images/image2.jpg', '102302177', 222.00, '<p>Rashmi has a problem saying no to people, so she starts to say &ldquo;Yes, but I won&rsquo;t be able to get to it until...&rdquo; or &ldquo;I&rsquo;d love to do that, but I have this, this and this, so can I get some assistance with some of it?&rdquo; depending on whether she is talking with a co-worker or a manager.</p>', '<p>Rashmi has project work assignments, but other managers and even her teammates ask her to help with things, and so this makes her late on her assignments.&nbsp;</p>', 'Commitment Problems ', '', 'Rashmi', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Commitment Problems ', 'Commitment Problems ', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(19, 2, 'Give and Take  ', 'productimages/images/image2.jpg', '', 222.00, '<p>Rashmi figures out why she is doing the extra work. Is it because she just wants to help out, or is this extra work something that may lead to opportunities in the future. In this case, she&rsquo;s just being friendly and so she starts to back away from the extra work by saying that she is too busy with work and personal commitments. The teammate pushes Rashmi to keep doing the extra work (because Rashmi is so wonderful, etc.), but Rashmi sticks to her plan of what she can do, and by when, after which she won&rsquo;t be able to do any more extra work.</p>\r\n<p class="MsoNormal"><o:p></o:p></p>', '<p>Rashmi has been helping a teammate out a lot, often putting in nights and weekends, but when Rashmi asks for help, the teammate is &ldquo;too busy&rdquo;. Rashmi is hurt that the teammate won&rsquo;t put in the extra effort to help her.</p>', 'Give and Take  ', '', 'Rashmi', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Give and Take  ', 'Give and Take  ', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(20, 2, 'Unwanted Attention   ', 'productimages/images/image2.jpg', '', 222.00, '<p>Clearly, Rashmi&rsquo;s &ldquo;appropriate behavior&rdquo; isn&rsquo;t working - some of the guys simply do not pick up the hints. She needs to make it clear that she appreciates the kindness, but she needs to be more assertive in terms of letting certain men know that their behavior is not appropriate, especially when it becomes a pattern over time. She needs to let the guys know that their behavior has moved from kindness to inappropriate. They need to back away. She needs to emphasize that if they don&rsquo;t back away, she will be forced to report their inappropriate behavior to management.</p>', '<p>Rashmi is not inviting attention, but she some of the guys at work are giving her a lot of (generally) unwanted attention. 1 or 2 co-workers act professionally with her. They are fun and supportive, and always act appropriately and respectfully. 1 or 2 &#8232;co-workers are usually appropriate and respectful, but do something that is borderline (like spending too much time, or being too sweet).1 co-worker is clearly inappropriate. Rashmi acts appropriately, and tries to provide the right hints to the co-workers. The focus is mostly about the co-worker&rsquo;s behaviors.</p>', 'Unwanted Attention  ', '', 'Rashmi', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Unwanted Attention  ', 'Unwanted Attention  ', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(21, 2, 'Why won’t they listen to me?    ', 'productimages/images/image2.jpg', '', 112.00, '<p>After the meeting Rashmi and Ram reflect on the good things the co-worker did (that they helped with) so that the presentation would go well: 1. Co-Worker: Asking for someone to help/review before the presentation. 2. Co-Worker: Admitting to yourself what your strengths and weaknesses are, and doing something about them (join Toastmasters, for example) 3. Practicing your presentation. 4. Asking for help from mentors. 5. Rashmi &amp; Ram: Improving their feedback (which links to the Feedback is Your Friend theme).</p>', '<p>One of the co-workers has a good idea, but their communication skills are poor so they have a hard time getting their ideas accepted. Presentation is not well organized, not well supported, uses poor grammar/diction and has lots of spelling errors. Not very professional, and so doesn&rsquo;t get a good response from management. Co-worker talks with Rashmi and Ram about their disappointment. Rashmi and Ram give good advice, but don&rsquo;t give it as well as they could.</p>', 'Why won’t they listen to me?    ', '', 'Rashmi', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Why won’t they listen to me?    ', 'Why won’t they listen to me?    ', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(22, 2, 'Looking good    ', 'productimages/images/image2.jpg', '', 112.00, '<p>The co-worker who has noticed the mistake tells the person who made the original mistake without making a big deal of it. Ram and Rashmi are impressed with the co-worker for doing this, and appreciate the good work environment that this fosters.</p>\r\n<p class="MsoNormal"><o:p></o:p></p>', '<p>A co-worker makes a big mistake, but they are unaware of the mistake. Ram and Rashmi overhear a different co-worker who has noticed the mistake making a big deal of this, mocking the person who made the mistake and spreading the work so management will eventually notice. Rashmi watches Ram talk with the co-worker who has noticed the mistake about needing to tell the person who made the original mistake. Ram can&rsquo;t convince him, so Ram decides to tell the original mistake maker. Rashmi is impressed with Ram for doing this.</p>', 'Looking good    ', '', 'Rashmi', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Looking good    ', 'Looking good    ', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(23, 2, 'Ram gives advice to Rashmi    ', 'productimages/images/image2.jpg', '', 112.00, '<p>Ram does a good job of giving feedback/advice (uses positive styles, for example). Ram&rsquo;s body language, tone, sincerity, etc. also improve for coping.</p>\r\n<p class="MsoNormal"><o:p></o:p></p>', '<p>Ram has good advice to give to Rashmi, but he confuses/mixes the good advice with gossip and some of his ego-feeding, so Rashmi doesn&rsquo;t take the advice well. Ram&rsquo;s advice makes some sense, but is mixed in with nonsense. Rashmi brushes Ram off, so Ram feels put off. This causes them to not work well together, which becomes noticeable to the rest of the team. Meera sees the coldness between them and steps in and to talk with them, privately at first and then both together.</p>\r\n<p class="MsoNormal"><o:p></o:p></p>', 'Ram gives advice to Rashmi    ', '', 'Rashmi', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Ram gives advice to Rashmi    ', 'Ram gives advice to Rashmi    ', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(24, 1, 'Consequences of Disrespectful Behavior - Personal Setting', 'productimages/images/image2.jpg', '', 222.00, '<p>Krish and Priti give each other feedback on what happened.</p>', '<p>Krish treats his girl friend disrespectfully.&nbsp;</p>\r\n<div>Krish and his girl friend (Priti) join a few friends at a coffee shop after work. &nbsp;The friends and Krish are doing a lot of texting, so Priti becomes bored and feels ignored.</div>\r\n<div>&nbsp;</div>', 'Consequences of Disrespectful Behavior - Personal Setting', '', 'Krish', '', 'Prithi', '', '', '', '', '', '', '', '', '', '', '', 'Consequences of Disrespectful Behavior - Personal Setting', 'Consequences of Disrespectful Behavior - Personal Setting', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(25, 1, 'Giving Feedback Well', 'productimages/images/image2.jpg', '', 222.00, '<p>Husband comes home frustrated, but is able to vent his frustration to his wife in a positive manner.&nbsp;</p>', '<p>Being sweet isn&rsquo;t enough to change someone&rsquo;s mood.&nbsp;</p>\r\n<div>Being sweet isn&rsquo;t enough to change someone&rsquo;s mood.</div>\r\n<div>&nbsp;</div>\r\n<div>Pooja&rsquo;s husband, Ramesh, comes home from work obviously upset. &nbsp;Pooja notices, and tries to make it better by being sweet. &nbsp;Pooja assumes her sweetness will change Ramesh&rsquo;s mood, but Ramesh ignores the sweetness and continues to be in a bad mood. &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Pooja demands to know why she deserves to be treated poorly. &nbsp;Ramesh tells her that he is very frustrated by his work/career, and he needs to take his frustrations out on Pooja. &nbsp;Isn&rsquo;t that one of the roles of a good wife?</div>\r\n<div>&nbsp;</div>', 'Giving Feedback Well', '', 'Pooja', '', 'Ramesh', '', '', '', '', '', '', '', '', '', '', '', 'Giving Feedback Well', 'Giving Feedback Well', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(26, 1, 'Appreciate Effort ', 'productimages/images/image2.jpg', '', 222.00, '<p>When wife serves dosas and says they are slightly burned, husband says how much he appreciates all she does for him, they look great and he begins eating them while engaging her in fun conversation.</p>', '<p>Husband doesn&rsquo;t appreciate what wife does for him.&nbsp;</p>\r\n<div>A wife makes dosas for her husband, but they aren&rsquo;t perfect so the husband mocks his wife and her cooking skills. The wife, obviously hurt, takes the plate of dosas from the kitchen table back to the kitchen. Is the husband&rsquo;s behavior aligned with his goals?</div>\r\n<div>&nbsp;</div>', 'Appreciate Effort ', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Appreciate Effort ', 'Appreciate Effort ', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(27, 1, 'We display our values through our behavior', 'productimages/images/image2.jpg', '', 222.00, '<p>The boyfriend talks with his fianc&eacute; about her concerns, and how he isn&rsquo;t his father.&nbsp;</p>', '<p>A young man behaves like his father.&nbsp;</p>\r\n<div>A young woman is worried that because she has a career, after they&rsquo;ve married and have kids she won&rsquo;t be able to take it all on and do it well. Her fianc&eacute;&rsquo;s father mocks her views. The fianc&eacute; and mother say nothing.</div>\r\n<div>&nbsp;</div>', 'We display our values through our behavior', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'We display our values through our behavior', 'We display our values through our behavior', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(28, 1, 'Are you aware:  people are talking about you', 'productimages/images/image2.jpg', '', 222.00, '<p>Co-workers appreciate Suraj apologizing for his intimidating behavior.&nbsp;&nbsp;</p>', '<p>Suraj is not aware of how his dominating and intimidating behavior is hurting his career.</p>\r\n<div>&nbsp;</div>\r\n<div>Suraj dominates the conversation in meetings. &nbsp;What Suraj isn&rsquo;t aware of is how people are talking about his behavior, including management.&nbsp;</div>\r\n<div>&nbsp;</div>', 'Are you aware:  people are talking about you', '', 'Suraj', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Are you aware:  people are talking about you', 'Are you aware:  people are talking about you', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(29, 1, 'Should leaders dominate?', 'productimages/images/image2.jpg', '', 0.00, '<p>A quiet person gently insists on getting answers to key questions.</p>', '<p>A team is arguing about project issues and direction. &nbsp;One person is quiet and patient, and just asks questions to help direct the team, but team doesn&rsquo;t hear the questions. &nbsp;&nbsp;</p>\r\n<div>A team is having problems listening to each other.&nbsp;</div>\r\n<div>&nbsp;</div>', 'Should leaders dominate?', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Should leaders dominate?', 'Should leaders dominate?', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(30, 1, 'I Speak My Mind', 'productimages/images/image2.jpg', '', 222.00, '<p>Sometimes you can be right, but you&rsquo;re &ldquo;dead right&rdquo;&nbsp;</p>\r\n<div>A mother and her daughters argue about her younger daughter being too picky when choosing a boyfriend.</div>\r\n<div>&nbsp;</div>', '<p>Sometimes you can be right, but you&rsquo;re &ldquo;dead right&rdquo;&nbsp;</p>\r\n<div>A mother and her daughters argue about her younger daughter being too picky when choosing a boyfriend.</div>\r\n<div>&nbsp;</div>', 'I Speak My Mind', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'I Speak My Mind', 'I Speak My Mind', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(31, 1, 'I’m not a bully', 'productimages/images/image2.jpg', '', 222.00, '<p>Friends and family help a young teenage boy cope with teasing about his weight.</p>', '<p>Friends and family help Rohan with his problem.&nbsp;</p>\r\n<div>A group of young teenage friends tease one of their group about his weight</div>\r\n<div>&nbsp;</div>', 'I’m not a bully', '', 'Rohan', '', '', '', '', '', '', '', '', '', '', '', '', '', 'I’m not a bully', 'I’m not a bully', '2014-08-05', 1, 'research');
INSERT INTO `sas_themes` VALUES(32, 2, 'My way is better (Ram at College)', 'productimages/images/image2.jpg', '103515364', 0.00, '<p>Ram recognizes that the goal of his first assignment at work is to complete his tasks in a timely and quality manner, to do what he can do help make the project successful, to be a good team player and to learn how he grow on the job.</p>', '<p>Ram recognizes that the goal of his first assignment at work is to complete his tasks in a timely and quality manner, to do what he can do help make the project successful, to be a good team player and to learn how he grow on the job.</p>', 'My way is better (Ram at College)', '', 'Ram', 'productimages/images/hemanth.png', 'Hemanth', 'productimages/images/manoj.png', 'Manoj', 'productimages/images/meera.png', 'Meera', '', '', '', '', 'Know what your goals are.---Have long antenna so you can pick up the clues being sent to you.---Be able to receive feedback well (how to grow your antenna).---Trust.', '', '', '', '', '0000-00-00', 1, '');
INSERT INTO `sas_themes` VALUES(35, 0, '', '', '', 0.00, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `sas_users`
--

CREATE TABLE `sas_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `email` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(25) NOT NULL,
  `photopath` varchar(266) NOT NULL,
  `date_added` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sas_users`
--

INSERT INTO `sas_users` VALUES(1, 'panduj', 'babu', 'pandubabu2010@gmail.com', 'pandubabu', 'pandubabu', '042929_r1.jpg', '2014-02-27', 1);
INSERT INTO `sas_users` VALUES(2, 'Harsha', 'Aluri', 'harsha.aluri@yahoo.com', 'harsha', 'harsha', '085541_meca.jpg', '2014-03-01', 1);
INSERT INTO `sas_users` VALUES(3, 'test', 'test', 'test@gmail.com', 'test123', 'test123', '', '2014-03-03', 1);
INSERT INTO `sas_users` VALUES(4, 'panduj', 'babu', 'jangampandubabu@gmail.com', 'pandubabuj', 'pandubabuj', '060200_1.jpg', '2014-03-10', 1);
INSERT INTO `sas_users` VALUES(5, 'jvcchyosot', 'jvcchyosot', 'qkqnsv@ejfamj.com', 'jvcchyosot', '', '', '2014-03-29', 1);
INSERT INTO `sas_users` VALUES(6, 'Meghna', 'Vivaswat', 'meghs7@gmail.com', 'meghna7', 'scarlet_red', '', '2014-08-15', 1);
INSERT INTO `sas_users` VALUES(7, 'Martin', 'Radley', 'martinradley@gmail.com', 'Martin', 'patches', '085642_martin_radley.jpg', '2014-08-15', 1);
INSERT INTO `sas_users` VALUES(8, 'rajat', 'reddy', 'meghna@msitprogram.net', 'rajat', 'rajat123', '', '2014-08-19', 1);
INSERT INTO `sas_users` VALUES(9, 'Kris', 'Ankem', 'kris.ankem@gmail.com', 'kris', 'silver', '', '2014-08-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sas_videos`
--

CREATE TABLE `sas_videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL,
  `prod_name` varchar(60) NOT NULL,
  `prod_image` varchar(255) NOT NULL,
  `vcode` varchar(20) NOT NULL,
  `vtype` tinyint(1) NOT NULL DEFAULT '0',
  `prod_price` int(10) NOT NULL,
  `pagetitle` text NOT NULL,
  `description` text NOT NULL,
  `btopics` text NOT NULL,
  `tags` text NOT NULL,
  `mresources` text NOT NULL,
  `mkeywords` text NOT NULL,
  `mdescription` text NOT NULL,
  `date_added` date DEFAULT NULL,
  `prod_type` varchar(30) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

--
-- Dumping data for table `sas_videos`
--

INSERT INTO `sas_videos` VALUES(1, 1, 'The Consequences of Disrespectful Behavior ( At  Work )', 'productimages/images/image1.png', '103498463', 1, 3434, 'The Consequences of Disrespectful Behavior ( At  Work )', '<div>Krish treats co-workers disrespectfully.</div>\r\n<div>&nbsp;</div>\r\n<div>Krish is the lead on a technical project team. &nbsp;Two of Krish&rsquo;s co-workers from another department meet with Krish to let him know about a serious problem with how the product they are developing will be deployed.</div>\r\n<div>&nbsp;</div>\r\n<div>Krish doesn&rsquo;t think that there is anything they can do to resolve the problem, so he doesn&rsquo;t give them his full attention.</div>\r\n<div>&nbsp;</div>', '', '', '', 'The Consequences of Disrespectful Behavior - Work Setting', 'The Consequences of Disrespectful Behavior - Work Setting', '2014-08-21', '', 1);
INSERT INTO `sas_videos` VALUES(2, 1, 'Cheese on Your Chin', 'productimages/images/image2.png', '', 0, 2324, 'Cheese on Your Chin', '<div>Only someone who cares will tell you that you have cheese on your chin.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Rakesh is a project lead, and one of the people on his team, Ravi, has not been performing well over the past few months. &nbsp;Rakesh meets privately with Ravi to give Ravi feedback on his behavior, but the meeting doesn&rsquo;t go well. &nbsp;</div>\r\n<div>&nbsp;</div>', '', '', '', 'Cheese on Your Chin', 'Cheese on Your Chin', '2014-08-21', '', 1);
INSERT INTO `sas_videos` VALUES(3, 1, 'Consequences of Disrespectful Behavior - Personal Setting', 'productimages/images/image3.png', '', 0, 2332, 'Consequences of Disrespectful Behavior - Personal Setting', '<p>Krish treats his girl friend disrespectfully.&nbsp;</p>\r\n<div>Krish and his girl friend (Priti) join a few friends at a coffee shop after work. &nbsp;The friends and Krish are doing a lot of texting, so Priti becomes bored and feels ignored.</div>', '', '', '', '', '', '2014-08-22', '', 1);
INSERT INTO `sas_videos` VALUES(4, 1, 'Giving Feedback Well', 'productimages/images/image4.png', '', 0, 222, 'Giving Feedback Well', '<div>Being sweet isn&rsquo;t enough to change someone&rsquo;s mood.</div>\r\n<div>&nbsp;</div>\r\n<div>Pooja&rsquo;s husband, Ramesh, comes home from work obviously upset. &nbsp;Pooja notices, and tries to make it better by being sweet. &nbsp;Pooja assumes her sweetness will change Ramesh&rsquo;s mood, but Ramesh ignores the sweetness and continues to be in a bad mood. &nbsp;</div>\r\n<div>&nbsp;</div>\r\n<div>Pooja demands to know why she deserves to be treated poorly. &nbsp;Ramesh tells her that he is very frustrated by his work/career, and he needs to take his frustrations out on Pooja. &nbsp;Isn&rsquo;t that one of the roles of a good wife?</div>', '', '', '', 'Giving Feedback Well', 'Giving Feedback Well', '2014-08-22', '', 1);
INSERT INTO `sas_videos` VALUES(5, 2, 'My way is better (Ram at Work)', 'productimages/images/img1(ram at work).png', '103498464', 0, 222, 'My way is better (Ram at Work)', '<p>Ram uses the same techniques he used successfully at college to address project problems on his work project, with disastrous results.&nbsp;</p>\r\n<div>Ram disagrees with how his new work project is organized, and he feels that his first assignment (to organize and write the project&rsquo;s final findings into a presentation to senior management) is beneath him. Unfortunately, Ram doesn&rsquo;t have the tools to perceive how his team is really trying to help him move his career forward, and that they have done this type of project before so he should trust them. &nbsp;How will Ram resolve these issues, and will he be successful?&nbsp;</div>', 'Know what your goals are.---Have long antenna so you can pick up the clues being sent to you.---Be able to receive feedback well (how to grow your antenna)---Trust.', '', '', '', '', '2014-08-22', '', 1);
INSERT INTO `sas_videos` VALUES(6, 2, 'Being a team player (Ram at College)', 'productimages/images/img2(ram at college).png', '103498465', 0, 222, 'Being a team player (Ram at College)', '<p>Ram&rsquo;s college project is &ldquo;successful&rdquo;, or is it?&nbsp;&nbsp;</p>\r\n<div>Ram, Reena, Rahul, Karan and Asha have all been assigned to complete a project at school. Ram has the knowledge and skills to successfully complete the project, but his teammates are lacking. Ram does the project by himself and the team gets a good grade. Isn&rsquo;t that what matters?</div>\r\n<div>&nbsp;</div>', 'Knowing the difference between getting a good grade and being able to do the work.---Team Skills.---Having short antenna means you won''t be able to see the clues being sent to you.---Be able to receive feedback well (how to grow your antenna)', '', '', '', '', '2014-08-22', '', 1);
INSERT INTO `sas_videos` VALUES(7, 2, 'Interrupting', 'productimages/images/img3(interrupting).png', '', 0, 222, 'Interrupting', '<p>Ram sometimes dominates conversations by interrupting people and talking over them. He does this to Rashmi during her first project kickoff meeting, and the other project team members don&rsquo;t act much better. How should Rashmi act when this happens? Is Ram a bad employee, and should he be let go?</p>\r\n<div>&nbsp;</div>\r\n<div>Rashmi is assigned to a new project. During her new project&rsquo;s kickoff meeting Rashmi tries to participate, but is interrupted and &ldquo;talked over&rdquo; by Ram and her other teammates. How should Rashmi act when this happens? Should she plan on leaving this job for a better one?</div>\r\n<div>&nbsp;</div>', '', '', '', '', '', '2014-08-22', '', 1);
INSERT INTO `sas_videos` VALUES(8, 2, 'Taking ownership of your skills ', 'productimages/images/img4(Taking Ownership of your Skills).png', '', 0, 222, 'Taking ownership of your skills ', '<p>Rashmi and a teammate are assigned to work on a piece of the project. The teammate is not able to do the work (they have experience in this skill on their resume, but skipped school that day). At first the teammate is defensive and argumentative with Rashmi, then the teammate asks Rashmi to cover for him. Their deliverable is due in two weeks, and during an integration planning meeting the teammate makes it look like Rashmi is the problem. What should Rashmi do?</p>\r\n<p class=\\"MsoNormal\\"><o:p></o:p></p>', '', '', '', '', '', '2014-08-22', '', 1);
INSERT INTO `sas_videos` VALUES(9, 1, 'Appreciate Effort ', 'productimages/images/image5.png', '', 0, 222, 'Appreciate Effort ', '<p>&nbsp;Husband doesn&rsquo;t appreciate what wife does for him.</p>\r\n<div>&nbsp;</div>\r\n<div>A wife makes dosas for her husband, but they aren&rsquo;t perfect so the husband mocks his wife and her cooking skills. The wife, obviously hurt, takes the plate of dosas from the kitchen table back to the kitchen. Is the husband&rsquo;s behavior aligned with his goals?&nbsp;</div>\r\n<div>&nbsp;</div>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_videos` VALUES(10, 1, 'We display our values through our behavior', 'productimages/images/image6.png', '', 0, 222, 'We display our values through our behavior', '<p>A young man behaves like his father.</p>\r\n<div>&nbsp;</div>\r\n<div>A young woman is worried that because she has a career, after they&rsquo;ve married and have kids she won&rsquo;t be able to take it all on and do it well. Her fianc&eacute;&rsquo;s father mocks her views. The fianc&eacute; and mother say nothing.</div>\r\n<div>&nbsp;</div>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_videos` VALUES(11, 1, 'Are you aware:  people are talking about you', 'productimages/images/image7.png', '', 0, 222, 'Are you aware:  people are talking about you', '<div>Suraj is not aware of how his dominating and intimidating behavior is hurting his career.</div>\r\n<div>&nbsp;</div>\r\n<div>Suraj dominates the conversation in meetings. &nbsp;What Suraj isn&rsquo;t aware of is how people are talking about his behavior, including management.&nbsp;</div>\r\n<div>&nbsp;</div>\r\n<p>&nbsp;</p>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_videos` VALUES(12, 1, 'Should leaders dominate?', 'productimages/images/image8.png', '', 0, 222, 'Should leaders dominate?', '<p>A team is arguing about project issues and direction. &nbsp;One person is quiet and patient, and just asks questions to help direct the team, but team doesn&rsquo;t hear the questions. &nbsp;</p>\r\n<div>&nbsp;</div>\r\n<div>A team is having problems listening to each other.&nbsp;</div>\r\n<div>&nbsp;</div>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_videos` VALUES(13, 1, 'I Speak My Mind', 'productimages/images/image9.png', '', 0, 222, 'I Speak My Mind', '<div>Sometimes you can be right, but you&rsquo;re &ldquo;dead right&rdquo;</div>\r\n<div>&nbsp;</div>\r\n<div>A mother and her daughters argue about her younger daughter being too picky when choosing a boyfriend.</div>\r\n<div>&nbsp;</div>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_videos` VALUES(14, 1, 'I\\''m not a bully', 'productimages/images/image10.png', '', 0, 222, 'I\\''m not a bully', '<p>Friends and family help Rohan with his problem.</p>\r\n<div>&nbsp;</div>\r\n<div>A group of young teenage friends tease one of their group about his weight.</div>\r\n<div>&nbsp;</div>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_videos` VALUES(15, 2, 'Commitment Problems', 'productimages/images/img5(Commitment Problems).png', '', 0, 222, 'Commitment Problems', '<p>Rashmi has project work assignments, but other managers and even her teammates ask her to help with things, and so this makes her late on her assignments.</p>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_videos` VALUES(16, 2, 'Give and Take  ', 'productimages/images/img6(Give and Take).png', '', 0, 222, 'Give and Take  ', '<p>Rashmi has been helping a teammate out a lot, often putting in nights and weekends, but when Rashmi asks for help, the teammate is &ldquo;too busy&rdquo;. Rashmi is hurt that the teammate won&rsquo;t put in the extra effort to help her.</p>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_videos` VALUES(17, 2, 'Unwanted Attention   ', 'productimages/images/img7(Unwanted Attention).png', '', 0, 222, 'Unwanted Attention   ', '<p>Rashmi is not inviting attention, but she some of the guys at work are giving her a lot of (generally) unwanted attention. 1 or 2 co-workers act professionally with her. They are fun and supportive, and always act appropriately and respectfully. 1 or 2 &#8232;co-workers are usually appropriate and respectful, but do something that is borderline (like spending too much time, or being too sweet).1 co-worker is clearly inappropriate. Rashmi acts appropriately, and tries to provide the right hints to the co-workers. The focus is mostly about the co-worker&rsquo;s behaviors.</p>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_videos` VALUES(18, 2, 'Why won\\''t they listen to me?', 'productimages/images/img8.png', '', 0, 222, 'Why won\\''t they listen to me?', '<p>One of the co-workers has a good idea, but their communication skills are poor so they have a hard time getting their ideas accepted. Presentation is not well organized, not well supported, uses poor grammar/diction and has lots of spelling errors. Not very professional, and so doesn&rsquo;t get a good response from management. Co-worker talks with Rashmi and Ram about their disappointment. Rashmi and Ram give good advice, but don&rsquo;t give it as well as they could.</p>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_videos` VALUES(19, 2, 'Looking good    ', 'productimages/images/img9(Looking Good).png', '', 0, 222, 'Looking good    ', '<p><span style=\\"font-size:12.0pt;font-family:&quot;Times New Roman&quot;,&quot;serif&quot;;\r\nmso-fareast-font-family:&quot;&#65325;&#65331; &#26126;&#26397;&quot;;mso-fareast-theme-font:minor-fareast;\r\nmso-ansi-language:EN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\\">A co-worker makes a big mistake, but they are unaware of the mistake. Ram and Rashmi overhear a different co-worker who has noticed the mistake making a big deal of this, mocking the person who made the mistake and spreading the work so management will eventually notice. Rashmi watches Ram talk with the co-worker who has noticed the mistake about needing to tell the person who made the original mistake. Ram can&rsquo;t convince him, so Ram decides to tell the original mistake maker. Rashmi is impressed with Ram for doing this.</span></p>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_videos` VALUES(20, 2, 'Ram gives advice to Rashmi', 'productimages/images/img10(Ram Gives Advice to Rashmi).png', '', 0, 222, 'Ram gives advice to Rashmi', '<p>Ram has good advice to give to Rashmi, but he confuses/mixes the good advice with gossip and some of his ego-feeding, so Rashmi doesn&rsquo;t take the advice well. Ram&rsquo;s advice makes some sense, but is mixed in with nonsense. Rashmi brushes Ram off, so Ram feels put off. This causes them to not work well together, which becomes noticeable to the rest of the team. Meera sees the coldness between them and steps in and to talk with them, privately at first and then both together.</p>', '', '', '', '', '', '2014-08-23', '', 1);
INSERT INTO `sas_videos` VALUES(22, 3, 'Video Title 1', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(23, 3, 'Video Title 2', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(24, 3, 'Video Title 3', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(25, 3, 'Video Title 4', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(26, 3, 'Video Title 5', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(27, 3, 'Video Title 6', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(28, 3, 'Video Title  7', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(29, 3, 'Video Title  8', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(30, 3, 'Video Title 9', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(31, 3, 'Video Title 10', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(32, 4, 'Video 1', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(33, 4, 'Video 2', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(34, 4, 'Video 3', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(35, 4, 'Video 4', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(36, 4, 'Video 5', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(37, 4, 'Video 6', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(38, 4, 'Video 7', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(39, 4, 'Video 8', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(40, 4, 'Video 9', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(41, 4, 'Video 10', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(42, 5, 'Video 1', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(43, 5, 'Video 2', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(44, 5, 'Video 3', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(45, 5, 'Video 4', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(46, 5, 'Video 5', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(47, 5, 'Video 6', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(48, 5, 'Video 7', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(49, 5, 'Video 8', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(50, 5, 'Video 9', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(51, 5, 'Video 10', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(52, 6, 'Video 1', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(53, 6, 'Video 2', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(54, 6, 'Video 3', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(55, 6, 'Video 4', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(56, 6, 'Video 5', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(57, 6, 'Video 6', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(58, 6, 'Video 7', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(59, 6, 'Video 8', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(60, 6, 'Video 9', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(61, 6, 'Video 10', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(62, 7, 'Video 1', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(63, 7, 'Video 2', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(64, 7, 'Video 3', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(65, 7, 'Video 4', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(66, 7, 'Video 5', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(67, 7, 'Video 6', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(68, 7, 'Video 7', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(69, 7, 'Video 8', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(70, 7, 'Video 9', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(71, 7, 'Video 10', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(72, 8, 'Video 1', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(73, 8, 'Video 2', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(74, 8, 'Video 3', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(75, 8, 'Video 4', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(76, 8, 'Video 5', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(77, 8, 'Video 6', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(78, 8, 'Video 7', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(79, 8, 'Video 8', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(80, 8, 'Video 9', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(81, 8, 'Video 10', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(82, 9, 'Video 1', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(83, 9, 'Video 2', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(84, 9, 'Video 3', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(85, 9, 'Video 4', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(86, 9, 'Video 5', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(87, 9, 'Video 6', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(88, 9, 'Video 7', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(89, 9, 'Video 8', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(90, 9, 'Video 9', 'productimages/images/portfolio-item-1.jpg', '', 1, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(91, 9, 'Video 10', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(92, 10, 'Video 1', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(93, 10, 'Video 2', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(94, 10, 'Video 3', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(95, 10, 'Video 4', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(96, 10, 'Video 5', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(97, 10, 'Video 6', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(98, 10, 'Video 7', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(99, 10, 'Video 8', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(100, 10, 'Video 9', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
INSERT INTO `sas_videos` VALUES(101, 10, 'Video 10', 'productimages/images/portfolio-item-1.jpg', '', 0, 0, '', '', '', '', '', '', '', '2014-09-12', '', 1);
