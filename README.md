**Development Guidelines**
 
1. Any PHP framework can be used (Symfony preferred)
2. Any database storage method can be used (MySQL preferred)
3. Code should be committed in a github repository regularly (daily)
 
**Application Guidelines**
 
1.Create the database/tables for the below.
 
2.Create a login page that after successful login will access a maintenance form. Will validate against a valid user name and password.
 
3.A maintenance form will containing the following information for a “table”. Number of rows.

- Area Code
- Description
- Floor
- Row
- Column
 
The maintenance form will contain 4 options for a standard maintenance form – **Add, Delete, Edit** and **“Assignment”**.
 
4.The Delete option will contain “Yes” or “No” confirmation box on whether to continue with the delete or not.
 
5.The maintenance form will contain a logout button which when clicked will return to the login page
 
6.A “Assignment” button will redirect to a page which will dynamically display the row and columns for each table ID in a “grid style layout”.  
 
7.Each box is clickable where you can assign or modify a “Table Status” to one of:
 
- Reserved
- Available
- Unavailable
- Occupied 
 
The “table Status” should be stored. The default value will be “Available”
 
8.Sample Storyboard is below:
-  Please see attached image.

![](https://i.ibb.co/5BxQm7T/Flow.jpg)

