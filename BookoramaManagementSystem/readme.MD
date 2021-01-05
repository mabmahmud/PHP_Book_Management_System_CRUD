                          ***** Bookorama Management System *****

Part 1 can be started anytime and will be completed on your own time. I would like you to create a CRUD (create, retrieve, update, delete) site for the bookorama database. This work should be done on an INDIVIDUAL basis.

Any signs of plagiarism will be dealt with swiftly and seriously. However, you are free to use any of the resources I have provided in SAM.

index.php
this page will list all books currently in the db in a table on the page
there should be hyperlinks in the column headers to sort the list by author, price (ASC), clicking the link would re-display the page with the proper sort applied
all book fields should be displayed on the page
books should be sorted by title as the default
at the top there should be a link or a form that would allow a user to login (username: siteAdminAccount password: CISpass )
if the user IS logged in
they should see two other columns in the table - one with a link to EDIT, the other with a link to DELETE
clicking on either of these links will take the user to respective pages to edit that particular book details or delete that particular book
there should also be a hyperlink to Add a New Book (newBook.php) - which would allow the user to add a new book into the db. This fields should appear within the final row of the table (at the bottom)
/admin area
Your site should have a directory called /admin. All CRUD related pages should be in here and be PROTECTED. If someone tries to load these pages without being logged in they should be redirected to a login page (in the /admin directory) or given a message that it is a private area.
Within the admin area you will have all of your pages required to allow management of the book details (just details about books).
At the top of every page in the admin area, it should display the logged in username, an obvious message that the user is actually logged in, as well as a logout hyperlink.
Authentication - You have a couple of options:
Use the "external_users" table found in bookoramaV3.sql
Instead of dealing with a users table in our database, for simplicity, you have the option of hardcoding your login credentials into your PHP script. Use these credentials - (username: siteAdminAccount password: CISpass)
Clicking the logout hyperlink will log the user out and redirect them to the main index.php page.
'id" is the primary key for books. This field should NOT be editable. 
When allowing a user to edit a particular book, ensure that the form is prefilled with the existing data for the book.
When deleting books from the database, in order to maintain referential integrity, make sure not to leave orphan records in the other tables, i.e. order_items (HINT:ON DELETE CASCADE - See bookoramaV3.sql)
CSS
Your entire site should use a consistent theme. A popular CSS framework must be used. Use Bootstrap or some other current CSS framework for this.


Marking Matrix
/5 Page comments - header and inline - complete and professional - spell-checked and accurate
Code alignment and indentation
lowerCamelCasing (variables, page names, classes, etc.)
/40 Functionality
For each operation (create, retrieve, update, delete), ensure these aspects are covered
data security
form validation
user messages
db operations
any sorting operations
/10 Look and Feel
(3) All error/user messages are spell-checked and accurate/complete. All of these messages appear using the site-wide theme.
(4) Entire site uses a common theme, CSS framework is employed.
(3) Production Ready - How close is this application to production or release? Does it look professional and complete? Are the user messages complete such that a novice user would know how to use the system?
/5 Admin Area Lock Down- all protected pages should not be accessible unless user is logged in
/60 Total
Files should be submitted into the Final Exam Part One Dropbox. This will be due Sunday, Dec 6, 2020 by 11:55pm or earlier.  If you submit into the dropbox, you waive the right to resubmit. I will only accept ONE submission for this assignment. This will allow me to correct the early birds before waiting until the last minute