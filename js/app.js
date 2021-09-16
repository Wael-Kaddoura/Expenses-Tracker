const delete_button = `<button class="btn btn-danger delete_expense">Delete</button>`;

async function fetchCurrentCategories() {
  const response = await fetch(
    "http://localhost/expensestracker/php/get-categories.php"
  );
  if (!response.ok) {
    const message = "An error has occured";
    throw new Error(message);
  }
  const data = await response.json();
  return data;
}

async function addNewCategory(category) {
  try {
    result = await $.ajax({
      type: "POST",
      url: "http://localhost/expensestracker/php/add-category.php",
      data: { newcategory: category },
    });
  } catch (error) {
    console.log(error);
  }
}

function updateCategoryDropdown(categories) {
  $("#expense_category").empty();
  let choose_option = "<option selected>Choose...</option>";
  $("#expense_category").append(choose_option);
  for (const category in categories) {
    let option =
      "<option value=" + category + ">" + categories[category] + "</option>";
    $("#expense_category").append(option);
  }

  $("#edit_expense_category").empty();
  $("#edit_expense_category").append(choose_option);
  for (const category in categories) {
    let option =
      "<option value=" + category + ">" + categories[category] + "</option>";
    $("#edit_expense_category").append(option);
  }
}

async function fetchCurrentExpenses() {
  const response = await fetch(
    "http://localhost/expensestracker/php/get-expenses.php"
  );
  if (!response.ok) {
    const message = "An error has occured";
    throw new Error(message);
  }
  const data = await response.json();
  return data;
}

async function addNewExpense(amount, date, category) {
  try {
    result = await $.ajax({
      type: "POST",
      url: "http://localhost/expensestracker/php/add-expense.php",
      data: { amount: amount, date: date, category: category },
    });
  } catch (error) {
    console.log(error);
  }
}

async function deleteExpense(expense_id) {
  try {
    result = await $.ajax({
      type: "POST",
      url: "http://localhost/expensestracker/php/delete-expense.php",
      data: { expense_id: expense_id },
    });
    $("#expense_" + expense_id).remove();
  } catch (error) {
    console.log(error);
  }
}

async function editExpense(expense_id, amount, date, category_id) {
  try {
    result = await $.ajax({
      type: "POST",
      url: "http://localhost/expensestracker/php/edit-expense.php",
      data: {
        new_amount: amount,
        new_date: date,
        new_category_id: category_id,
        expense_id: expense_id,
      },
    });

    await fetchCurrentExpenses();
    await updateExpensesList();
  } catch (error) {
    console.log(error);
  }
}

function updateExpensesList(expenses) {
  $("#expenses_table").empty();

  for (const expense in expenses) {
    let edit_button = `
  <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editexpense${expense}" data-bs-whatever="@mdo">Edit</button>
  <div class="modal fade" id="editexpense${expense}" tabindex="-1" aria-labelledby="editexpense${expense}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editexpense">Edit Expense</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="expense_category" class="col-form-label">Category:</label>
              <div class="input-group mb-3">
                <select name="edit_expense_category" class="form-select" id="edit_expense_category_${expense}">
                  <option selected value = "${expense}">${expenses[expense]["category"]}</option>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label for="expense_amount" class="col-form-label">Amount ($):</label>
              <input type="text" class="form-control" id="edit_expense_amount_${expense}" name="edit_expense_amount_${expense}" value = "${expenses[expense]["amount"]}"> </div>
            <div class="mb-3">
              <label for="expense_date" class="col-form-label">Date:</label>
              <input type="date" class="form-control" id="edit_expense_date_${expense}" name="edit_expense_date_${expense}" value = "${expenses[expense]["date"]}"> </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-success edit_expense" value = "${expense}" data-bs-dismiss="modal">Edit Expense</button>
        </div>
		  </div>`;

    console.log(edit_button);
    let row =
      "<tr id = 'expense_" +
      expense +
      "'><td>" +
      expenses[expense]["category"] +
      "</td><td>$" +
      expenses[expense]["amount"] +
      "</td><td>" +
      expenses[expense]["date"] +
      "</td><td>" +
      edit_button +
      "</td><td>" +
      '<button class="btn btn-outline-danger delete_expense" value = "' +
      expense +
      '">Delete</button>' +
      "</td></tr>";

    $("#expenses_table").append(row);
  }

  $(".delete_expense").click(function (e) {
    e.preventDefault();
    let expense_id = $(this).val();
    deleteExpense(expense_id);
  });
}

$(document).ready(async function () {
  await fetchCurrentExpenses().then((results) => {
    let expenses = results;
    updateExpensesList(expenses);
  });

  await fetchCurrentCategories().then((results) => {
    let categories = results;
    updateCategoryDropdown(categories);
  });

  $(".delete_expense").click(function (e) {
    e.preventDefault();
    let expense_id = $(this).val();
    deleteExpense(expense_id);
  });

  $(".edit_expense").click(function (e) {
    e.preventDefault();
    let expense_id = $(this).val();
    let new_amount = $(`#edit_expense_amount_${expense_id}`).val();
    let new_date = $(`#edit_expense_date_${expense_id}`).val();
    let new_category_id = $(`#edit_expense_category_${expense_id}`).val();

    editExpense(new_amount, new_date, new_category_id, expense_id);
  });
});

$("#add_category").click(async function (e) {
  e.preventDefault();
  let new_category = $("#new_category").val();
  await addNewCategory(new_category);

  fetchCurrentCategories().then((results) => {
    let categories = results;
    updateCategoryDropdown(categories);
  });
});

$("#add_expense").click(async function (e) {
  e.preventDefault();
  let amount = $("#expense_amount").val();
  let date = $("#expense_date").val();
  let category = $("#expense_category").val();
  await addNewExpense(amount, date, category);

  $("#expense_amount").val("");
  $("#expense_date").val("");
  $("#expense_category").val("");

  fetchCurrentExpenses().then((results) => {
    let expenses = results;
    updateExpensesList(expenses);
  });
});
