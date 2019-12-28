TRUNCATE bookstates;
INSERT INTO bookstates 
SELECT NULL, idbook, cdkeep, cdlanguage, cdstatus, dtstart, dtfinished, ftreview FROM books
WHERE dtstart IS NOT NULL;
