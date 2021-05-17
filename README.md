# Faculty-Portal
	A faculty portal for a university to
	- View and store academic profile of faculties which include their background, publications, courses, education and achievements. Implemented using NoSQL database (MongoDB) with PHP. 
	- Apply for leaves and manage leave applications (approve/reject/comment) depending upon level of authority (Faculty/HOD/Dean/Director). Implemented using PostgreSQL database with PHP.

### Tech Stack
	PHP, PostgreSQL, MongoDB

### Run locally
- Installation Prerequisites
	-	PHP 8.0 or above, PostgreSQL
- Clone the repository
	-	$ git clone https://github.com/Poojaaggarwal1/Faculty-Portal.git
- Execute the Stored procedures and triggers in the sql directory.
- Replace the username and password for postgres in the header.php and login-header.php in the static directory
- Run the server at port 8080
	-	$ php -S localhost:8080
- Visit http://localhost:8080/ in a browser

