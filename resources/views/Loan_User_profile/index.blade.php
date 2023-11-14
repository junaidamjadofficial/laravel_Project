<!DOCTYPE html>
<html lang="en">

<head>
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
            <div class="h2"><a href="{{ route('Loan_User_profile.index') }}" class="text-white" style="text-decoration:none ">Loan User</a></div>
        </div>
    </div>
    <div class="container">
        <div class="d-flex py-3 justify-content-between">
            <div class="h4">Loan Users Profile</div>
            <div class="input-group w-25">
                <input type="text" id="searchInput" class="form-control" placeholder="Search Loan User"
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
                        <th>City</th>
                        <th>Name</th>
                        <th>cnic</th>
                        <th>Contact</th>
                        <th>Credit Limit</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    $i = ($loan_users->currentPage() - 1) * $loan_users->perPage();
                    ?>
                    @if ($loan_users->isNotEmpty())
                        @foreach ($loan_users as $item)
                            <tr valign="middle">
                                <td>{{ ++$i }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->city->name }}</td>
                                <td>{{ $item->Owner_name }}</td>
                                <td>{{ $item->cnic }}</td>
                                <td>{{ $item->phone_no }}</td>
                                <td>{{ $item->credit_limit }}</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm"
                                        onclick="openUserModal({{ $item->id }})" data-bs-toggle="modal"
                                        data-bs-target="#userModal">View</a>
                                    <a href="{{ route('Loan_User_profile.edit', $item->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <a href="#" onclick="deleteConfirmation({{ $item->id }})"
                                        class="btn btn-danger btn-sm">Delete</a>
                                    <form id="loan_user_{{ $item->id }}"
                                        action="{{ route('Loan_User_profile.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">Record not foound</td>
                        </tr>
                    @endif


                </table>
            </div>
        </div>
        <div class="mt-3">
            {{ $loan_users->links('pagination::bootstrap-5') }}
        </div>


</body>
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
                        <a class="nav-link active" id="loanUserTab" data-bs-toggle="tab" href="#loanUser" role="tab"
                            aria-controls="loanUser" aria-selected="true">Loan User</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="loanUserOtherDetailTab" data-bs-toggle="tab" href="#loanUserOtherDetail"
                            role="tab" aria-controls="loanUserOtherDetail" aria-selected="false">Loan User Other
                            Detail</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="loanUserShopDetailTab" data-bs-toggle="tab" href="#loanUserShopDetail"
                            role="tab" aria-controls="loanUserShopDetail" aria-selected="false">Loan User Shop
                            Detail</a>
                    </li>
                </ul>

                <!-- Tab content -->
                <div class="tab-content mt-3" id="userModalTabContent">
                    <div class="tab-pane fade show active" id="loanUser" role="tabpanel" aria-labelledby="loanUserTab">
                        <div id="loanUserDetails">
                            <!-- Loan User details will appear here -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="loanUserOtherDetail" role="tabpanel"
                        aria-labelledby="loanUserOtherDetailTab">
                        <!-- Load and display Loan User Other Detail data here -->
                        <div id="loanUserOtherDetails">
                            <!-- Loan User Other Detail details will appear here -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="loanUserShopDetail" role="tabpanel"
                        aria-labelledby="loanUserShopDetailTab">
                        <!-- Load and display Loan User Shop Detail data here -->
                        <div id="loanUserShopDetails">
                            <!-- Loan User Shop Detail details will appear here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function deleteConfirmation(id) {
        if (confirm("Are you sure, you want to delete?")) {
            document.getElementById('loan_user_' + id).submit();
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

    function populateLoanUserDetails(data) {
        $('#loanUserDetails').html(`
        <p><strong>Owner Name:</strong> ${data.Owner_name}</p>
        <p><strong>CNIC:</strong> ${data.cnic}</p>
        <p><strong>Contact:</strong> ${data.phone_no}</p>
        <p><strong>Credit limit:</strong> ${data.credit_limit}</p>
        <p><strong>BDO:</strong> ${data.user ? data.user.name : 'N/A'}</p>
        <p><strong>City:</strong> ${data.city ? data.city.name : 'N/A'}</p>
    `);
    }

    function populateLoanUserOtherDetails(loanUserOtherDetail) {
        $('#loanUserOtherDetails').html(`
        <p><strong>Owner Address:</strong> ${loanUserOtherDetail.Owner_address}</p>
        <p><strong>Date of Birth:</strong> ${loanUserOtherDetail.dob}</p>
        <p><strong>CNIC Issuance Date:</strong> ${loanUserOtherDetail.cnic_issuance_date}</p>
        <p><strong>Father's Name:</strong> ${loanUserOtherDetail.father_name}</p>
        <p><strong>Mother's Name:</strong> ${loanUserOtherDetail.Mother_name}</p>
        <p><strong>Consumer Type:</strong> ${loanUserOtherDetail.consumer_type}</p>
        <p><strong>Remarks:</strong> ${loanUserOtherDetail.remarks}</p>
    `);
    }

    function populateLoanUserShopDetails(loanUserShopDetail) {
        $('#loanUserShopDetails').html(`
        <p><strong>Shop Name:</strong> ${loanUserShopDetail.shop_name}</p>
        <p><strong>Shop Address:</strong> ${loanUserShopDetail.shop_address}</p>
        <p><strong>Shop Width:</strong> ${loanUserShopDetail.shop_width}</p>
        <p><strong>Shop Length:</strong> ${loanUserShopDetail.shop_length}</p>
        <p><strong>POP Code:</strong> ${loanUserShopDetail.pop_code}</p>
        <p><strong>Shop Status:</strong> ${loanUserShopDetail.shop_status}</p>
    `);
    }

    function openUserModal(userId) {
        const url = `/loan_users/${userId}`;

        $.ajax({
            url: url,
            method: 'GET',
            success: function(data) {
                populateLoanUserDetails(data.data);

                if (data.data.loan_user_other_detail) {
                    populateLoanUserOtherDetails(data.data.loan_user_other_detail);
                } else {
                    $('#loanUserOtherDetails').html(`<p>No Loan User Other Detail available.</p>`);
                }

                if (data.data.loan_user_shop_detail) {
                    populateLoanUserShopDetails(data.data.loan_user_shop_detail);
                } else {
                    $('#loanUserShopDetails').html(`<p>No shop details available for this user.</p>`);
                }

                const userModal = new bootstrap.Modal(document.getElementById('userModal'));
                $('#userModal').off('hidden.bs.modal');

                // Add an event listener for modal hide event
                $('#userModal').on('hidden.bs.modal', function(event) {
                    // Redirect to the Laravel index route
                    window.location.href =
                        '{{ route('Loan_User_profile.index') }}'; // Replace with your Laravel index route
                });

                userModal.show();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching loan user details:', error);
            }
        });
    }
</script>

</html>
