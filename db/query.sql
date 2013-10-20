SELECT `comic_id`,COUNT(*) FROM `chaps` WHERE STATUS>0 GROUP BY `comic_id`
HAVING COUNT(*) > 300 

