/**************************************************/
/*Керівник
 *************************************************/
INSERT into parameters (place_id, param_title_id, value, created_at, updated_at)
SELECT id,
       '1',
       kerivnik,
       now(),
       now()
 from tmp_places;

/**************************************************/
/*Телефон
 *************************************************/
INSERT into parameters (place_id, param_title_id, value, created_at, updated_at)
  SELECT id,
    '2',
    tel,
    now(),
    now()
  from tmp_places;

/**************************************************/
/*Е-маил
 *************************************************/
INSERT into parameters (place_id, param_title_id, value, created_at, updated_at)
  SELECT id,
    '3',
    email,
    now(),
    now()
  from tmp_places;
/**************************************************/
/*Site
 *************************************************/
INSERT into parameters (place_id, param_title_id, value, created_at, updated_at)
  SELECT id,
    '4',
    site,
    now(),
    now()
  from tmp_places;