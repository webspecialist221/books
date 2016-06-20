-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 19, 2015 at 08:41 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `ebook`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `content`
-- 

CREATE TABLE `content` (
  `id` int(6) NOT NULL auto_increment,
  `content_name` varchar(77) NOT NULL,
  `content_short_det` text NOT NULL,
  `content_long_det` text NOT NULL,
  `content_status` varchar(77) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `content`
-- 

INSERT INTO `content` VALUES (1, 'ismail', '  ds', 'ds', 'ds');

-- --------------------------------------------------------

-- 
-- Table structure for table `login`
-- 

CREATE TABLE `login` (
  `uname` varchar(44) NOT NULL,
  `password` varchar(44) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- Dumping data for table `login`
-- 

INSERT INTO `login` VALUES ('ajmal', 'bangash');
