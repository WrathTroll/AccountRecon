CREATE TABLE IF NOT EXISTS `transaction` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(64) NOT NULL,
`date` datetime NOT NULL,
`value` float NOT NULL DEFAULT 0.00,
`allocation_id` int(11) NOT NULL DEFAULT 0,
`recon_id` int(11) NOT NULL,
`created` datetime NOT NULL,
`modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(`id`)
) ENGINE = MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `recon` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`recon_type_id` int(11) NOT NULL,
`Month` int(2) NOT NULL,
`year` int(4) NOT NULL,
`open_balance` float NOT NULL,
`close_balance` float NOT NULL,
`created` datetime NOT NULL,
`modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(`id`)
) ENGINE = MyISAM DEFAULT CHARSET= utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `allocation` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(32) NOT NULL,
`created` datetime NOT NULL,
`modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(`id`)
) ENGINE = MyISAM DEFAULT CHARSET= utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `recon_type` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(32) NOT NULL,
`created` datetime NOT NULL,
`modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY(`id`)
) ENGINE = MyISAM DEFAULT CHARSET= utf8 AUTO_INCREMENT=1;
