INSERT INTO `csl_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES ('1', 'Vietnam', 'vietnam', '0');
INSERT INTO `csl_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES ('1', '1', 'location', 'Vietnam country', '0', '0');

INSERT INTO `csl_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES ('2', 'Hanoi', 'hanoi', '0');
INSERT INTO `csl_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES ('2', '2', 'location', 'Hanoi City of Vietnam', '1', '0');

INSERT INTO `csl_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES ('3', 'Halong', 'halong', '0');
INSERT INTO `csl_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES ('3', '3', 'location', 'Halong city of Vietnam', '1', '0');
