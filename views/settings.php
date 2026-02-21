
<!doctype html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <title>CBE ERP</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="assets/app.css"/>
</head>
<body>
  <div class="overlay" id="overlay"></div>

  <aside class="sidebar" id="sidebar">
    <div class="sb-top">
      <div class="brand">CBE</div>
      <div class="brand-text">
        <div class="t1">School ERP</div>
        <div class="t2"><?php echo htmlspecialchars($username); ?> • <?php echo htmlspecialchars($role); ?></div>
      </div>
      <button class="sb-toggle" id="btnToggle" title="Collapse/Expand">⟷</button>
    </div>

    <div class="sb-scroll">
      <div class="sb-section">Main Menu</div>

      <a href="#" class="sb-item active" data-page="student" data-tip="Student Management">
        <div class="sb-icon">👩‍🎓</div><div class="sb-label">Student Management</div>
      </a>
      <a href="#" class="sb-item" data-page="assessment" data-tip="Assessment & Competency Tracking">
        <div class="sb-icon">📊</div><div class="sb-label">Assessment &amp; Compentency Tracking</div>
      </a>
      <a href="#" class="sb-item" data-page="timetable" data-tip="Timetable & Scheduling">
        <div class="sb-icon">🗓️</div><div class="sb-label">Timetable &amp; Scheduling</div>
      </a>
      <a href="#" class="sb-item" data-page="fees" data-tip="Fees & Finance">
        <div class="sb-icon">💳</div><div class="sb-label">Fees &amp; Finance</div>
      </a>
      <a href="#" class="sb-item" data-page="comm" data-tip="Communication & Notifications">
        <div class="sb-icon">🔔</div><div class="sb-label">Communication &amp; Notifications</div>
      </a>
      <a href="#" class="sb-item" data-page="parent" data-tip="Parent Portal">
        <div class="sb-icon">👨‍👩‍👧</div><div class="sb-label">Parent Portal</div>
      </a>
      <a href="#" class="sb-item" data-page="reports" data-tip="Reports & Analytics">
        <div class="sb-icon">📈</div><div class="sb-label">Reports &amp; Analytics</div>
      </a>
      <a href="#" class="sb-item" data-page="users" data-tip="Users Portal">
        <div class="sb-icon">👤</div><div class="sb-label">Users Portal</div>
      </a>

      <div class="sb-section">Account</div>
      <a class="sb-item" href="auth/logout.php" data-tip="Logout">
        <div class="sb-icon">🚪</div><div class="sb-label">Logout</div>
      </a>
    </div>
  </aside>

  <main class="main" id="main">
    <!--<div class="topbar">
      <button class="btn btn-light btn-sm d-lg-none mr-2" id="btnMobileMenu">☰</button>
      <div class="chip">
        <span class="badge badge-primary" id="pageBadge">Student Management</span>
        <span class="ml-2 text-muted" id="statusText">Ready</span>
      </div>
    </div>
-->
    <div class="content">
      <!-- STUDENT MANAGEMENT -->
      <section id="page-student" class="page">
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h4 class="mb-0">Student Management</h4>
          <div class="text-muted small">DB-backed • Stored Procedures • Audit Trail</div>
        </div>

        <div class="row">
          <!-- Left -->
          <div class="col-lg-4 mb-3">
            <div class="card shadow-sm">
              <div class="card-header d-flex align-items-center justify-content-between">
                <strong>Actions</strong>
                <button class="btn btn-sm btn-primary" id="btnOpenReg">+ Register</button>
              </div>
              <div class="card-body">
                <div class="list-group mb-3" id="actionList">
                  <button class="list-group-item list-group-item-action" data-action="search">Search</button>
                  <button class="list-group-item list-group-item-action" data-action="filter">Filter</button>
                  <button class="list-group-item list-group-item-action" data-action="cancel">Cancel</button>
                  <button class="list-group-item list-group-item-action" data-action="list">List Display</button>
                </div>

                <div class="input-group mb-2">
                  <input class="form-control" id="q" placeholder="Search ADM / UPI / Name">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" id="btnSearch">Go</button>
                  </div>
                </div>

                <div class="list-group" id="studentList" style="max-height: 360px; overflow:auto;"></div>
              </div>
            </div>
          </div>

          <!-- Right -->
          <div class="col-lg-8 mb-3">
            <div class="card shadow-sm mb-3">
              <div class="card-header d-flex align-items-center justify-content-between">
                <strong>Selected Student Scorecard</strong>
                <span class="text-muted small">ADM • UPI • Guardian • Photo</span>
              </div>
              <div class="card-body" id="scorecard">
                <div class="row">
                  <div class="col-md-9">
                    <h5 id="scName">—</h5>
                    <div class="text-muted" id="scMeta">Select a student</div>

                    <div class="row mt-3">
                      <div class="col-sm-6"><div class="kv"><small>ADM</small><div id="scAdm">—</div></div></div>
                      <div class="col-sm-6"><div class="kv"><small>UPI</small><div id="scUpi">—</div></div></div>
                      <div class="col-sm-6 mt-2"><div class="kv"><small>Class / Stream</small><div id="scClass">—</div></div></div>
                      <div class="col-sm-6 mt-2"><div class="kv"><small>Gender</small><div id="scGender">—</div></div></div>
                      <div class="col-sm-6 mt-2"><div class="kv"><small>Guardian ID</small><div id="scGid">—</div></div></div>
                      <div class="col-sm-6 mt-2"><div class="kv"><small>Guardian</small><div id="scGuardian">—</div></div></div>
                    </div>
                  </div>
                  <div class="col-md-3 text-center">
                    <img id="scPhoto" src="" alt="Passport" class="img-fluid rounded border" style="max-height:140px; display:none;">
                    <div class="text-muted small mt-2" id="scPhotoHint">No photo</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabs -->
            <div class="card shadow-sm">
              <div class="card-header"><strong>Student Workspace</strong></div>
              <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab-reg">Registration</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-bio">Bio</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-fee">Fee</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-exams">Exams</a></li>
                  <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab-projects">Student Projects</a></li>
                </ul>

                <div class="tab-content pt-3">
                  <div class="tab-pane fade show active" id="tab-reg">
                    <div class="text-muted small">Registration happens via the Register modal. Scorecard shows saved ADM/UPI.</div>
                  </div>

                  <div class="tab-pane fade" id="tab-bio">
                    <form id="bioForm">
                      <div class="form-group">
                        <label>Class Teacher Name</label>
                        <input class="form-control" name="class_teacher_name" required>
                      </div>
                      <div class="form-group">
                        <label>Special Needs</label>
                        <input class="form-control" name="special_needs">
                      </div>
                      <div class="form-group">
                        <label>Pathway</label>
                        <select class="form-control" name="pathway" required>
                          <option>STEM</option>
                          <option>Social Sciences</option>
                          <option>Arts</option>
                          <option>Sports Sciences</option>
                        </select>
                      </div>
                      <button class="btn btn-primary">Save Bio</button>
                    </form>
                  </div>

                  <div class="tab-pane fade" id="tab-fee">
                    <div class="d-flex justify-content-between mb-2">
                      <button class="btn btn-sm btn-primary" id="btnAddFee">+ Add Fee</button>
                      <small class="text-muted">School Fee • Lunch • Transport • Club</small>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-sm" id="feeTable">
                        <thead><tr><th>Fee Item</th><th>Amount</th><th>Status</th><th style="width:160px;">Actions</th></tr></thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="tab-exams">
                    <div class="d-flex justify-content-between mb-2">
                      <button class="btn btn-sm btn-primary" id="btnAddExam">+ Add Exam</button>
                      <small class="text-muted">Stored procedures + audit</small>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-sm" id="examTable">
                        <thead><tr><th>Exam</th><th>Score</th><th>Term</th><th style="width:160px;">Actions</th></tr></thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>

                  <div class="tab-pane fade" id="tab-projects">
                    <div class="d-flex justify-content-between mb-2">
                      <button class="btn btn-sm btn-primary" id="btnAddProject">+ Add Project</button>
                      <small class="text-muted">Planned/In Progress/Submitted/Completed</small>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-sm" id="projectTable">
                        <thead><tr><th>Project</th><th>Status</th><th>Remarks</th><th style="width:160px;">Actions</th></tr></thead>
                        <tbody></tbody>
                      </table>
                    </div>
                  </div>

                </div><!-- tab-content -->
              </div>
            </div>

          </div>
        </div>
      </section>

      <!-- Placeholder pages -->
      <section id="page-assessment" class="page" style="display:none;"><div class="card p-4">Assessment & Competency Tracking</div></section>
      <section id="page-timetable" class="page" style="display:none;"><div class="card p-4">Timetable & Scheduling</div></section>
      <section id="page-fees" class="page" style="display:none;"><div class="card p-4">Fees & Finance</div></section>
      <section id="page-comm" class="page" style="display:none;"><div class="card p-4">Communication & Notifications</div></section>
      <section id="page-parent" class="page" style="display:none;"><div class="card p-4">Parent Portal</div></section>
      <section id="page-reports" class="page" style="display:none;"><div class="card p-4">Reports & Analytics</div></section>
      <section id="page-users" class="page" style="display:none;"><div class="card p-4">Users Portal</div></section>
    </div>
  </main>

  <!-- Registration Modal -->
  <div class="modal fade" id="studentRegModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Register Student</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>

        <form id="studentRegForm" enctype="multipart/form-data">
          <div class="modal-body">
            <div id="regMsg"></div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>UPI (manual, unique)</label>
                <input class="form-control" name="upi" required>
              </div>
              <div class="form-group col-md-6">
                <label>ADM (auto-generated)</label>
                <input class="form-control" value="Auto after save" disabled>
              </div>
            </div>

            <div class="form-group">
              <label>Student Full Names</label>
              <input class="form-control" name="full_name" required>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Gender</label>
                <select class="form-control" name="gender" required>
                  <option value="">Select</option><option>Male</option><option>Female</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label>Class</label>
                <select class="form-control" name="class_grade" required>
                  <option value="">Select</option>
                  <option>Grade 1</option><option>Grade 2</option><option>Grade 3</option>
                  <option>Grade 4</option><option>Grade 5</option><option>Grade 6</option>
                  <option>Grade 7</option><option>Grade 8</option><option>Grade 9</option>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label>Stream</label>
                <select class="form-control" name="stream" required>
                  <option value="">Select</option><option>Green</option><option>Blue</option><option>Red</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Date Registered</label>
                <input type="date" class="form-control" name="date_registered" required>
              </div>
              <div class="form-group col-md-6">
                <label>Pathway</label>
                <select class="form-control" name="pathway" required>
                  <option value="">Select</option>
                  <option>STEM</option><option>Social Sciences</option><option>Arts</option><option>Sports Sciences</option>
                </select>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Passport Photo (upload)</label>
                <input type="file" class="form-control-file" name="passport_file" accept=".jpg,.jpeg,.png,.pdf">
              </div>
              <div class="form-group col-md-6">
                <label>BirthCert Copy (upload)</label>
                <input type="file" class="form-control-file" name="birthcert_file" accept=".jpg,.jpeg,.png,.pdf">
              </div>
            </div>

            <div class="form-group">
              <label>Special Needs</label>
              <input class="form-control" name="special_needs">
            </div>

            <div class="form-group">
              <label>Class Teacher Name</label>
              <input class="form-control" name="class_teacher_name" required>
            </div>

            <hr>

            <div class="form-group">
              <label>Parent/Guardian Full Names</label>
              <input class="form-control" name="guardian_full_name" required>
            </div>
            <div class="form-group">
              <label>Parent/Guardian Phone</label>
              <input class="form-control" name="guardian_phone" required placeholder="07XXXXXXXX">
            </div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
            <button class="btn btn-primary" id="btnRegSave">Save Registration</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Reusable Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editTitle">Edit</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
          <form id="editForm">
            <input type="hidden" id="editKind">
            <input type="hidden" id="editId">
            <div class="form-group" id="editFields"></div>
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancel</button>
          <button class="btn btn-primary" id="btnSaveEdit" type="button">Save</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteTitle">Delete</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body" id="deleteBody">Are you sure?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-dismiss="modal" type="button">Cancel</button>
          <button class="btn btn-danger" id="btnConfirmDelete" type="button">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    window.API_URL = "api/index.php";
  </script>
  <script src="assets/app.js"></script>
</body>
</html>
