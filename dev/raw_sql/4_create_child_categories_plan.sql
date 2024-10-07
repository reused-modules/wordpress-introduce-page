INSERT INTO `csl_terms` (`name`, `slug`, `term_group`) VALUES ('SOLO TRAVEL', 'solo-travel', '0');
INSERT INTO `csl_term_taxonomy` (`taxonomy`, `description`, `parent`, `count`, `term_id`) VALUES ('category', '', '4', '0', (SELECT term_id FROM csl_terms WHERE slug = 'solo-travel'));

INSERT INTO `csl_terms` (`name`, `slug`, `term_group`) VALUES ('COUPLES TRAVEL', 'couples-travel', '0');
INSERT INTO `csl_term_taxonomy` (`taxonomy`, `description`, `parent`, `count`, `term_id`) VALUES ('category', '', '4', '0', (SELECT term_id FROM csl_terms WHERE slug = 'couples-travel'));

INSERT INTO `csl_terms` (`name`, `slug`, `term_group`) VALUES ('FEMALE TRAVEL', 'female-travel', '0');
INSERT INTO `csl_term_taxonomy` (`taxonomy`, `description`, `parent`, `count`, `term_id`) VALUES ('category', '', '4', '0', (SELECT term_id FROM csl_terms WHERE slug = 'female-travel'));

INSERT INTO `csl_terms` (`name`, `slug`, `term_group`) VALUES ('ECO TRAVEL', 'eco-travel', '0');
INSERT INTO `csl_term_taxonomy` (`taxonomy`, `description`, `parent`, `count`, `term_id`) VALUES ('category', '', '4', '0', (SELECT term_id FROM csl_terms WHERE slug = 'eco-travel'));
