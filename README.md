# invoices-form
Recruitment task

Project in symfony 4.4. I used php 7.3.

The best option is running it by the docker containers (nginx, php-fpm, mysql).

Used bundles:
- FosUserBundle
- Dompdf
- ninsuo/symfony-collection

#Functions:
- Anonymous user and logged user can generate invoices.
- Only logged user as admin can see all generated invoices.
- Only logged user as admin can generate any created invoice.
- Only logged user as admin can delete any invoice.
- Register is disabled for new users.
- Invoices are generated as pdf file.


