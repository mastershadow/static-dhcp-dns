-- phpMyAdmin SQL Dump
-- version 4.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Lug 21, 2016 alle 15:41
-- Versione del server: 5.5.49-0ubuntu0.14.04.1
-- Versione PHP: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `static_dhcp_dns`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `host`
--

CREATE TABLE IF NOT EXISTS `host` (
  `id` int(11) NOT NULL,
  `hostname` varchar(255) COLLATE utf8_bin NOT NULL,
  `domain` varchar(255) COLLATE utf8_bin NOT NULL,
  `ipv4` varchar(15) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `ptr` tinyint(1) NOT NULL DEFAULT '0',
  `dhcp` tinyint(1) NOT NULL DEFAULT '0',
  `hwaddr` varchar(12) CHARACTER SET ascii COLLATE ascii_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `host`
--
ALTER TABLE `host`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hostname` (`hostname`,`domain`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `host`
--
ALTER TABLE `host`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  