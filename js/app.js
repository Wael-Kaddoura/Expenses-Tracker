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
    let json_object = JSON.stringify({ new_category_name: category });
    result = await $.ajax({
      type: "POST",
      url: "http://localhost/expensestracker/php/add-category.php",
      data: { new_category: json_object },
    });
  } catch (error) {
    console.log(error);
  }
}

function updateCategoryDropdown(categories) {
  $("#expense_category").empty();
  for (const category in categories) {
    let option =
      "<option value=" + category + ">" + categories[category] + "</option>";
    $("#expense_category").append(option);
  }

  $(".edit_expense_category").empty();
  for (const category in categories) {
    let option =
      "<option value=" + category + ">" + categories[category] + "</option>";
    $(".edit_expense_category").append(option);
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

async function fetchGroupedExpenses() {
  const response = await fetch(
    "http://localhost/expensestracker/php/get-expenses-grouped.php"
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
    let json_object = JSON.stringify({
      amount: amount,
      date: date,
      category: category,
    });
    result = await $.ajax({
      type: "POST",
      url: "http://localhost/expensestracker/php/add-expense.php",
      data: { new_expense_data: json_object },
    });
  } catch (error) {
    console.log(error);
  }
}

async function deleteExpense(expense_id) {
  try {
    let json_object = JSON.stringify({ expense_id: expense_id });
    result = await $.ajax({
      type: "POST",
      url: "http://localhost/expensestracker/php/delete-expense.php",
      data: { expense: json_object },
    });
    $("#expense_" + expense_id).remove();
    await fetchGroupedExpenses().then((results) => {
      let grouped_expenses = results;
      buildPieChart(grouped_expenses);
    });
  } catch (error) {
    console.log(error);
  }
}

async function editExpense(expense_id, amount, date, category_id) {
  try {
    let json_object = JSON.stringify({
      new_amount: amount,
      new_date: date,
      new_category_id: category_id,
      expense_id: expense_id,
    });

    result = await $.ajax({
      type: "POST",
      url: "http://localhost/expensestracker/php/edit-expense.php",
      data: { edited_expense_data: json_object },
    });

    await fetchCurrentExpenses().then(async (results) => {
      let expenses = results;
      await updateExpensesList(expenses);

      await fetchGroupedExpenses().then((results) => {
        let grouped_expenses = results;
        buildPieChart(grouped_expenses);
      });
    });

    await fetchCurrentCategories().then((results) => {
      let categories = results;
      updateCategoryDropdown(categories);
    });
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
                <select name="edit_expense_category" class="form-select edit_expense_category" id="edit_expense_category_${expense}">
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

    let delete_button = `<button class="btn btn-outline-danger delete_expense" value = "${expense}">Delete</button>`;

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
      delete_button +
      "</td></tr>";

    $("#expenses_table").append(row);
  }

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

    editExpense(expense_id, new_amount, new_date, new_category_id);
  });
}

function buildPieChart(expenses) {
  $("#pie").empty();
  // set the data
  let data = [];

  for (const expense in expenses) {
    let category = expenses[expense]["category"];
    let sum = expenses[expense]["sum"];
    data.push({ x: category, value: sum });
  }

  // create the chart
  var chart = anychart.pie();

  // set the chart title
  chart.title("Total Expenses Grouped by Category");

  // add the data
  chart.data(data);

  // display the chart in the container
  chart.container("pie");
  chart.draw();
}

async function fetchPageStats() {
  const response = await fetch(
    "http://localhost/expensestracker/php/load-page-stats.php"
  );
  if (!response.ok) {
    const message = "An error has occured";
    throw new Error(message);
  }
  const data = await response.json();
  return data;
}

async function pageLoad() {
  await fetchPageStats().then(async (results) => {
    let stats = results;
    if (stats["is_logedin"]) {
      let action = `<a class="nav-link" href="php/logout.php">Logout</a>`;
      $("#user_action").append(action);

      let username = stats["username"];
      $("#username").text(username);

      $("#not_loggedin").empty();

      await fetchCurrentExpenses().then(async (results) => {
        let expenses = results;
        await updateExpensesList(expenses);

        await fetchGroupedExpenses().then((results) => {
          let grouped_expenses = results;
          buildPieChart(grouped_expenses);
        });
      });

      await fetchCurrentCategories().then((results) => {
        let categories = results;
        updateCategoryDropdown(categories);
      });
    } else {
      let action = `<a class="nav-link" href="login.php">Login</a>`;
      $("#user_action").append(action);

      $("#loggedin").empty();
    }
  });
}

$(document).ready(async function () {
  pageLoad();
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

  fetchCurrentExpenses().then(async (results) => {
    let expenses = results;
    await updateExpensesList(expenses);

    await fetchGroupedExpenses().then((results) => {
      let grouped_expenses = results;
      buildPieChart(grouped_expenses);
    });
  });
});
