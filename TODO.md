# TODO: Fix Database Errors for Login and Registration

## Steps to Complete

- [x] Fix database name in `proyectos/dbconexion/dbconexion.php` (remove .sql extension)
- [x] Add `user` table to `proyectos/dbactividades.sql` with required fields
- [x] Add `registerUsuario` method in `proyectos/todolist/backend/query/user.php`
- [x] Update `loginUsuario` method to use password hashing verification
- [x] Update `proyectos/todolist/backend/api/endpoint.php` to handle registration endpoint
- [x] Import updated SQL dump into MySQL database (completed by user)
- [ ] Test login and registration functionality
