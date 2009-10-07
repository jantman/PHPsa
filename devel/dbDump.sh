#!/bin/bash
mysqldump PHPsa > ../dump.sql
mysqldump --no-data PHPsa > ../schema.sql