# Expenses-Tracker

A browser application that allows users to register and login to do the following:

  - Add/Edit expenses (also delete)
    - With a date
    - Amount
    - Category of expense
  - List all expenses
  - Create a side view that uses an external AnyChart JS library to show the expenses in a pie chart, grouped by categories.

The application has a backend that the web page can interact with through asynchronous calls. The APIs are json based, and securely separate the user data from each other, without a possibility of leakage between them.
