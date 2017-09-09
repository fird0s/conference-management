## Conference Manager

This system will be used to manage conference – participants, papers, revenues / expenses (admin will insert data, it won’t be connected to bank account), mailing. <br> 

The system work both on PC and mobile phone/tablet and should be properly displayed there (responsive). It should be simple to work with and clear. We’ll have admin that will manage everything and participants, that will have different possibilities depending on the role. After every edit or change it should see pop up window to confirm change.

### Participants

<b>Register form</b>

Here can register: participant without paper, participant with paper, sponsor.<br>
The form contains: academic title, name*, surname*, place of work*, correspondence address*, phone*, e-mail*, admission to the conference (participant without paper, participant with paper, sponsor)*, data for the bill, tax number. Records should be secured to insert only numbers in phone, only valid email address etc.<br>
After registering system should send password (random - letters, numbers, special chars, 10 signs) to the participant’s email account.<br>

<b>Panel after log-in</b>
All participants should have posibilities to: see conference infos, show data to make payment (name, address, account number, payment title), change password, change place of work, change correspondence address, change phone, confirm payment (he inserts amount, f.e. 500€ and admin will see: „Sponsor [name, surname] confirmed payment - 500€”, two fields to insert: PLN and EUR or expandable list to choose currency). <br>

### Admin

He can:
- mailing: send email to all users, only for sponsors, participants with paper, participants without paper, only for one selected user, only for several selected users. It should be text and attachments. Also mailing history should be available.
- show statistics: number of users divided to roles, number of papers divided to way of presentation, number of reviews, number of accepted papers, 
- list all participants with possibility to sort them by: name and surname, role [sponsor, participant with paper, etc.], place of work. Records we can see: academic title, name and surname, place of work, address, tel. number, email, role, number if papers reported, payment(participant confirmed[yes/no]/admin confirmed[yes/no]).
- add new participant account (academic title, name*, surname*, place of work*, correspondence address*, phone*, e-mail*, admission to the conference (participant without paper, participant with paper, sponsor)*, data for the bill, tax number).
- remove accounts, 
- list expenses (title, amount, date),
- add new expense: expense description, amount [format: 100.00], date (calendar widget with today selected by default),
- list all papers – title, author, date of entry, author (name and surname), status: [summary inserted, subject acceptance, reviewed – ready to print, rejected],
- change paper status [summary inserted, subject acceptance, reviewed – ready to print, rejected], set way of presentation (speaking, poster session)
- assign a review to the paper,
- insert new paper for user,
- confirm payment (its not when participant confirms it, admin checks if the payment is on the account and then he clicks to confirm that it really is and insert amount, two fields: PLN and EUR for two currencies),
- list users with their payments: name and surname, place of work, data for the bill, role of the user, revenue in PLN and EUR (it shouldn’t be calculated, admin will insert PLN or EUR amount), date of revenue entry



