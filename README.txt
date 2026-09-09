MDP (My Digital Portfolio) is a student portfolio site. 

A `User` class handles account info and safely checks it against the database; 
the register and login pages just create a User and ask it to sign someone up or log them in. 

Before that happens, form input gets cleaned up (extra spaces, unsafe characters removed), 
and if something's wrong, the same page reloads with an error instead of sending the user elsewhere. 

To avoid repeating code, the site reuses one shared header/footer/navbar and one shared database connection across all its pages.