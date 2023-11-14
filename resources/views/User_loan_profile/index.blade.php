<!DOCTYPE html>
<html lang="en">

<head>
    <!-- ... (your head section remains the same) ... -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="bg-warning py-3">
        <div class="Container">
            <div class="h2"><a href="{{ route('User_loan_profile.index') }}" class="text-white"
                    style="text-decoration:none">User Loan</a></div>
        </div>
    </div>
    <div class="container">
        <div class="d-flex py-3 justify-content-between">
            <div class="h4">User Loan Profile</div>
            <div class="input-group w-25">
                <input type="text" id="searchInput" class="form-control" placeholder="Search User Loan"
                    oninput="filterTable()">
                <div id="resultCount" class="align-self-center ml-3"></div>
            </div>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="card border-0 shadow-lg">
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>BDO</th>
                        <th>loan plan</th>
                        <th>Loan User</th>
                        <th>Contact</th>
                        <th>amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $i = ($user_loans->currentPage() - 1) * $user_loans->perPage();
                    ?>
                    @if ($user_loans->isNotEmpty())
                        @foreach ($user_loans as $item)
                            <tr valign="middle">
                                <td>{{ ++$i }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->loan_plan->loan_name }}</td>
                                <td>{{ $item->loan_user->Owner_name }}</td>
                                <td>{{ $item->phone_no }}</td>
                                <td>{{ $item->amount }}</td>
                                <td>{{ $item->status }}</td>

                                <td>
                                    <a href="#" class="btn btn-warning btn-sm"
                                        onclick="openUserModal({{ $item->id }})" data-bs-toggle="modal"
                                        data-bs-target="#userModal">View</a>
                                    <a href="{{ route('User_loan_profile.edit', $item->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="#" onclick="deleteConfirmation({{ $item->id }})"
                                        class="btn btn-danger btn-sm">Delete</a>
                                    <form id="user_loan_{{ $item->id }}" action="{{ route('User_loan_profile.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">Record not found</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
        <div class="mt-3">
            {{ $user_loans->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="userModalTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="loanUserTab" data-bs-toggle="tab" href="#loanUser"
                                role="tab" aria-controls="loanUser" aria-selected="true">Loan User</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="userLoanTransactionsTab" data-bs-toggle="tab"
                                href="#userLoanTransactions" role="tab" aria-controls="userLoanTransactions"
                                aria-selected="false">User Loan Transactions</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="userLoanChargesTab" data-bs-toggle="tab" href="#userLoanCharges"
                                role="tab" aria-controls="userLoanCharges" aria-selected="false">User Loan
                                Charges</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="userLoanInstallmentsTab" data-bs-toggle="tab"
                                href="#userLoanInstallments" role="tab" aria-controls="userLoanInstallments"
                                aria-selected="false">User Loan Installments</a>
                        </li>
                    </ul>

                    <!-- Tab content -->
                    <div class="tab-content mt-3" id="userModalTabContent">
                        <div class="tab-pane fade show active" id="loanUser" role="tabpanel"
                            aria-labelledby="loanUserTab">
                            <div id="userloanDetails">
                                <!--user loan details will appear here -->
                            </div>
                        </div>

                        <div class="tab-pane fade" id="userLoanTransactions" role="tabpanel"
                            aria-labelledby="userLoanTransactionsTab">
                            <!-- Load and display User Loan Transactions data here -->
                            <div id="userLoanTransactionsDetails">
                                <!-- User Loan Transactions details will appear here -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="userLoanCharges" role="tabpanel"
                            aria-labelledby="userLoanChargesTab">
                            <!-- Load and display User Loan Charges data here -->
                            <div id="userLoanChargesDetails">
                                <!-- User Loan Charges details will appear here -->
                            </div>
                        </div>
                        <div class="tab-pane fade" id="userLoanInstallments" role="tabpanel"
                            aria-labelledby="userLoanInstallmentsTab">
                            <!-- Load and display User Loan Installments data here -->
                            <div id="userLoanInstallmentsDetails">
                                <!-- User Loan Installments details will appear here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script type="text/javascript">
    function deleteConfirmation(id) {
        if (confirm("Are you sure, you want to delete?")) {
            console.log(id);
            document.getElementById('user_loan_' + id).submit();
        }
    }

    function filterTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toLowerCase();
        table = document.querySelector(".table");
        tr = table.getElementsByTagName("tr");
        var count = 0;

        for (i = 1; i < tr.length; i++) { // Start from 1 to skip the header row
            tds = tr[i].getElementsByTagName("td");
            var found = false;
            for (j = 2; j < 5; j++) {
                td = tds[j];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        count++;
                        break;
                    }
                }
            }
            tr[i].style.display = found ? "" : "none";
        }
        var resultCountElement = document.getElementById("resultCount");
        resultCountElement.textContent = "Total matches: " + count;
    }

    function populateUserLoanDetails(data) {
        $('#userloanDetails').html(`
        
        <p><strong>BDO: </strong> ${data.user ? data.user.name :'N/A'}</p>
        <p><strong>User Loan: </strong> ${data.loan_user ? data.loan_user.Owner_name :'N/A'}</p>
        <p><strong>Loan Plan:</strong> ${data.loan_plan ? data.loan_plan.loan_name : 'N/A'}</p>
        <p><strong>Phone Number:</strong> ${data.phone_no}</p>
        <p><strong>Amount:</strong> ${data.amount}</p>
        <p><strong>Status:</strong> ${data.status}</p>
    `);
    }

    function populateUserLoanTransactions(userLoanTransactions) {
        $('#userLoanTransactions').html(`
        <p><strong>User Loan:</strong> ${userLoanTransactions.user_loan_id}</p>
        <p><strong>Trx_id:</strong> ${userLoanTransactions.Trx_id}</p>
        <p><strong>Trx_code:</strong> ${userLoanTransactions.Trx_code}</p>
        <p><strong>Trx_response:</strong> ${userLoanTransactions.Trx_response}</p>
        <p><strong>Amount:</strong> ${userLoanTransactions.amount}</p>
        <p><strong>Type:</strong> ${userLoanTransactions.type}</p>
    `);
    }

    function populateUserLoanInstallments(userLoanInstallments) {
        $('#userLoanInstallments').html(`
        <p><strong>Date:</strong> ${userLoanInstallments.Date}</p>
        <p><strong>Due Date:</strong> ${userLoanInstallments.due_date}</p>
        <p><strong>Paid Date:</strong> ${userLoanInstallments.paid_date}</p>
        <p><strong>Amount:</strong> ${userLoanInstallments.amount}</p>
        <p><strong>Outstanding:</strong> ${userLoanInstallments.Outstanding}</p>
        
    `);
    }

    function populateUserLoanCharges(userLoanCharges) {
        console.log(userLoanCharges);
        $('#userLoanChargesDetails').html(`
        <p><strong>User Loan ID:</strong> ${userLoanCharges.user_loan_id}</p>
        <p><strong>Loan Plan ID:</strong> ${userLoanCharges.loan_plan_id}</p>
        <p><strong>Charges Amount:</strong> ${userLoanCharges.charges_amount}</p>
        <p><strong>Outstanding:</strong> ${userLoanCharges.Outstanding}</p>
        <p><strong>Amount disburse:</strong> ${userLoanCharges.Amount_disperse}</p>
        <p><strong>Federal Excise Duty (FED):</strong> ${userLoanCharges.fed}</p>

    `);
    }

    function openUserModal(userId) {
        const url = `/user_loans/${userId}`;
        $.ajax({
            url: url,
            method: 'GET',

            success: function(data) {

                populateUserLoanDetails(data.data);
                if (data.data.user_loan_charges) {
                    populateUserLoanCharges(data.data.user_loan_charges);
                } else {
                    // Handle the case when there are no charges available for this user loan
                    // You can modify this as needed
                    $('#userLoanCharges').html(`<p>No User Loan Charges available.</p>`);
                }

                if (data.data.user_loan_installment) {
                    populateUserLoanInstallments(data.data.user_loan_installment);
                } else {
                    // Handle the case when there are no installments available for this user loan
                    // You can modify this as needed
                    $('#userLoanInstallments').html(`<p>No User Loan Installments available.</p>`);
                }

                if (data.data.user_loan_transaction) {
                    populateUserLoanTransactions(data.data.user_loan_transaction);
                } else {
                    // Handle the case when there are no transactions available for this user loan
                    // You can modify this as needed
                    $('#userLoanTransactions').html(`<p>No User Loan Transactions available.</p>`);
                }

                // The rest of your code for showing the modal, and handling modal hide event
            },
            error: function(xhr, status, error) {
                console.error('Error fetching user loan details:', error);
            }
        });
    }
</script>
