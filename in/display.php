<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Enrollment Records</title>
    <link rel="icon" type="image/x-icon" href="../Pics/Logos/Lagro_High_School_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
        }

        .active {
            display: block !important;
        }

        main {
            display: flex;
        }

        .sidebar-container {
            position: relative;
            margin-bottom: -10px;
        }

        .container {
            display: flex;
        }

        .table-main {
            width: 100%;
            margin-top: 20px;
        }

        /* Table */
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 2px solid black;
            border-radius: 12px 12px 0px 0px;
            height: 60px;
            padding: 0 20px;
            gap: 20px;
            background-color: white;
        }

        .header-filters {
            display: flex;
            gap: 15px;
        }

        .header-filters select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .search-bar {
            border-radius: 8px;
            padding: 8px 12px;
            border: 1px solid #ccc;
            width: 250px;
            font-size: 14px;
            margin-right: -35px;
            padding-right: 35px;
        }

        .search-btn {
            position: relative;
            background-color: #ffffff00;
            border: none;
            cursor: pointer;
            font-size: 18px;
        }

        .header-filters select:hover {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            background-color: #f5f5f5;
        }

        .table-container {
            width: 100%;
            border: 2px solid black;
            border-top: none;
            border-radius: 0px 0px 12px 12px;
            overflow-x: auto;
            background-color: white;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        tbody tr {
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        tbody tr:hover {
            background-color: #f9f9f9;
        }

        td {
            text-align: center;
            vertical-align: middle;
            padding: 12px;
        }

        thead tr {
            background-color: #f5f5f5;
            border-bottom: 2px solid #000;
        }

        .id-cell {
            font-family: monospace;
            font-size: 0.8rem;
            color: #555;
        }

        td img {
            border-radius: 50%;
            object-fit: cover;
        }

        /* BADGES */
        .badge {
            display: inline-block;
            padding: 0.2rem 0.55rem;
            border-radius: 20px;
            font-size: 0.73rem;
            font-weight: 500;
        }

        .badge-male {
            background: #dbeafe;
            color: #1e40af;
        }

        .badge-female {
            background: #fce7f3;
            color: #9d174d;
        }

        .badge-grade {
            background: #e8f5e9;
            color: rgb(10, 89, 52);
        }

        /* Modal Styles */
        .modal-overlay {
            z-index: 1000;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-items: center;
            align-content: center;
            position: fixed;
            top: 0;
            left: 0;
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
        }

        .modal-overlay.open {
            visibility: visible;
            opacity: 1;
            pointer-events: all;
        }

        .modal {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            max-width: 700px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 15px;
        }

        .modal-header-left {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
        }

        .modal-title {
            font-weight: bold;
            font-size: 22px;
            color: #333;
        }

        .modal-subtitle {
            font-size: 0.75rem;
            color: #888;
            font-family: monospace;
        }

        .modal-close {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .modal-close:hover {
            background-color: #da190b;
        }

        .modal-body {
            overflow-y: auto;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .student-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .student-info-row {
            display: flex;
            gap: 30px;
            margin-bottom: 8px;
        }

        .student-info-item {
            flex: 1;
        }

        .student-info-label {
            font-weight: bold;
            color: #555;
            font-size: 12px;
        }

        .student-info-value {
            color: #333;
            margin-top: 2px;
        }

        .records-section {
            margin-top: 20px;
        }

        .records-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
        }

        .section-label {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 15px;
            color: #333;
        }

        .modal-record {
            background-color: #f9f9f9;
            padding: 12px;
            margin-bottom: 12px;
            border-radius: 4px;
        }

        .modal-record-date {
            font-size: 11px;
            color: #888;
            margin-bottom: 8px;
        }

        .modal-record-text {
            color: #333;
            font-size: 13px;
            word-wrap: break-word;
            white-space: pre-wrap;
            line-height: 1.5;
        }

        .loading {
            text-align: center;
            padding: 20px;
            color: #888;
        }

        .no-results {
            text-align: center;
            padding: 40px;
            color: #888;
        }

        .btn-action {
            padding: 6px 12px;
            font-size: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view {
            background-color: #4CAF50;
            color: white;
        }

        .btn-view:hover {
            background-color: #45a049;
        }

        .btn-edit {
            background-color: #2196F3;
            color: white;
        }

        .btn-edit:hover {
            background-color: #0b7dda;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.84rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .info-table tr {
            border-bottom: 1px solid #ddd;
        }

        .info-table tr:last-child {
            border-bottom: none;
        }

        .info-table th {
            background: #f1f1f1;
            text-align: left;
            padding: 0.6rem 0.9rem;
            font-size: 0.75rem;
            font-weight: 500;
            color: #555;
            width: 38%;
            vertical-align: top;
        }

        .info-table td {
            padding: 0.6rem 0.9rem;
            color: #333;
        }

        .mono {
            font-family: monospace;
            font-size: 0.8rem;
            color: #555;
        }

        .page-header {
            margin-bottom: 2rem;
            display: none;
        }

        .page-header h1 {
            font-size: 1.6rem;
            font-weight: 600;
            letter-spacing: -0.03em;
        }

        .page-header p {
            font-size: 0.85rem;
            color: #555;
            margin-top: 0.25rem;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-x: hidden;
        }

        .table-wrapper {
            display: none;
        }
    </style>
</head>
<body>

<div class="sidebar-container">
    <?php include "../include/sidebar.php" ?>
</div>

<div class="main-content">

<div class="page-header">
    <h1>Pre-Enrollment Records</h1>
    <p>Click on any student row to view full details.</p>
</div>

<div class="table-main">
    <div class="table-header">
        <div class="header-filters">
            <select id="gradeFilter">
                <option value="">All Grades</option>
            </select>
        </div>
        <div class="search">
            <input type="text" class="search-bar" id="searchInput" placeholder="Search by name...">
            <button class="search-btn" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                </svg></button>
        </div>
    </div>

    <div class="table-container">
        <table cellpadding="10" cellspacing="0" class="table" border="0">
            <thead>
                <tr>
                    <th style="text-align: center; width: 15%;">Applicant ID</th>
                    <th style="text-align: center; width: 30%;">Full Name</th>
                    <th style="text-align: center; width: 12%;">LRN</th>
                    <th style="text-align: center; width: 15%;">Grade Level</th>
                    <th style="text-align: center; width: 12%;">Sex</th>
                    <th style="text-align: center; width: 16%;">Date Enrolled</th>
                </tr>
            </thead>
            <tbody id="studentTableBody">
            <?php
            include "../include/enroll.php";

            $sql = "SELECT * FROM pre_enroll_table";
            $result = mysqli_query($conn, $sql);
            $students = [];

            if ($result && $result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
                    $id = $row['Applicant_id'];
                    $students[$id] = $row;
                    $fullName = htmlspecialchars($row['f_Name'] . ' ' . $row['m_Name'] . ' ' . $row['l_Name']);
                    $sexBadge = $row['sex'] === 'Male' ? 'badge-male' : 'badge-female';
            ?>
                <tr onclick="openModal('<?= htmlspecialchars($id, ENT_QUOTES) ?>')">
                    <td class="id-cell"><?= htmlspecialchars($id) ?></td>
                    <td style="text-transform: uppercase;"><strong><?= $fullName ?></strong></td>
                    <td class="id-cell"><?= htmlspecialchars($row['lrn_id']) ?></td>
                    <td><span class="badge badge-grade"><?= htmlspecialchars($row['grade_lvl']) ?></span></td>
                    <td><span class="badge <?= $sexBadge ?>"><?= htmlspecialchars($row['sex']) ?></span></td>
                    <td><?= htmlspecialchars($row['pre_enroll_date']) ?></td>
                </tr>
            <?php
                endwhile;
            else:
                echo "<tr><td colspan='6' class='no-results'>No records found</td></tr>";
            endif;
            ?>
            </tbody>
        </table>
    </div>
</div>

</div><!-- end .main-content -->

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay" onclick="closeOnBackdrop(event)">
    <div class="modal">
        <div class="modal-header">
            <div class="modal-header-left">
                <div class="modal-title" id="modalName">—</div>
                <div class="modal-subtitle" id="modalId">—</div>
            </div>
            <button class="modal-close" onclick="closeModal()">✕</button>
        </div>
        <div class="modal-body">

            <!-- SECTION 1: Student Info -->
            <div>
                <div class="section-label">Student Information</div>
                <table class="info-table">
                    <tr><th>Applicant ID</th><td><span class="mono" id="m_applicant_id"></span></td></tr>
                    <tr><th>LRN</th><td><span class="mono" id="m_lrn"></span></td></tr>
                    <tr><th>Full Name</th><td id="m_fullname"></td></tr>
                    <tr><th>Birthdate</th><td id="m_bday"></td></tr>
                    <tr><th>Age</th><td id="m_age"></td></tr>
                    <tr><th>Sex</th><td id="m_sex"></td></tr>
                    <tr><th>Mother Tongue</th><td id="m_tongue"></td></tr>
                    <tr><th>IP Community</th><td id="m_ip"></td></tr>
                    <tr><th>4Ps Beneficiary</th><td id="m_4ps"></td></tr>
                    <tr><th>4Ps ID</th><td id="m_4ps_id"></td></tr>
                    <tr><th>Disability</th><td id="m_disability"></td></tr>
                    <tr><th>Birth Certificate No.</th><td><span class="mono" id="m_birthcert"></span></td></tr>
                    <tr><th>Birthplace</th><td id="m_birthplace"></td></tr>
                    <tr><th>Current Address</th><td id="m_curr_add"></td></tr>
                    <tr><th>Permanent Address</th><td id="m_perm_add"></td></tr>
                </table>
            </div>

            <!-- SECTION 2: Guardian/Parents Info -->
            <div>
                <div class="section-label">Guardian / Parents Information</div>
                <table class="info-table">
                    <tr><th>Father's Name</th><td id="m_father"></td></tr>
                    <tr><th>Father's Contact</th><td><span class="mono" id="m_father_contact"></span></td></tr>
                    <tr><th>Mother's Name</th><td id="m_mother"></td></tr>
                    <tr><th>Mother's Contact</th><td><span class="mono" id="m_mother_contact"></span></td></tr>
                    <tr><th>Guardian's Name</th><td id="m_guardian"></td></tr>
                    <tr><th>Guardian's Contact</th><td><span class="mono" id="m_guardian_contact"></span></td></tr>
                </table>
            </div>

            <!-- SECTION 3: Enrollment Info -->
            <div>
                <div class="section-label">Enrollment Information</div>
                <table class="info-table">
                    <tr><th>Grade Level</th><td id="m_grade"></td></tr>
                    <tr><th>Track</th><td id="m_track"></td></tr>
                    <tr><th>Strand / Pathway</th><td id="m_pathway"></td></tr>
                    <tr><th>Semester</th><td id="m_sem"></td></tr>
                    <tr><th>School Year</th><td id="m_schyr"></td></tr>
                    <tr><th>Learning Modality</th><td id="m_modality"></td></tr>
                    <tr><th>Last Grade Completed</th><td id="m_lastgrade"></td></tr>
                    <tr><th>Last School Attended</th><td id="m_lastsch"></td></tr>
                    <tr><th>Last Year Completed</th><td id="m_lastyr"></td></tr>
                    <tr><th>School ID</th><td><span class="mono" id="m_schid"></span></td></tr>
                    <tr><th>Has LRN</th><td id="m_withlrn"></td></tr>
                    <tr><th>Returning Student</th><td id="m_returning"></td></tr>
                    <tr><th>Pre-Enrollment Date</th><td id="m_date"></td></tr>
                </table>
            </div>

        </div>
    </div>
</div>

<script>
const STUDENTS = <?= json_encode($students, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

function openModal(id) {
    const data = STUDENTS[id];
    if (!data) return;

    document.getElementById('modalName').textContent =
        data.f_Name + ' ' + data.m_Name + ' ' + data.l_Name +
        (data.ext_name && data.ext_name !== 'none' ? ' ' + data.ext_name : '');
    document.getElementById('modalId').textContent =
        'Applicant ID: ' + data.Applicant_id + '  ·  LRN: ' + data.lrn_id;

    document.getElementById('m_applicant_id').textContent = data.Applicant_id;
    document.getElementById('m_lrn').textContent = data.lrn_id;
    document.getElementById('m_fullname').textContent =
        data.f_Name + ' ' + data.m_Name + ' ' + data.l_Name +
        (data.ext_name && data.ext_name !== 'none' ? ' ' + data.ext_name : '');
    document.getElementById('m_bday').textContent = data.b_Day;
    document.getElementById('m_age').textContent = data.age;
    document.getElementById('m_sex').textContent = data.sex;
    document.getElementById('m_tongue').textContent = data.m_Tongue;
    document.getElementById('m_ip').textContent =
        data.ip_community === 'Yes' ? 'Yes – ' + data.specific_com : 'No';
    document.getElementById('m_4ps').textContent = data['4ps'];
    document.getElementById('m_4ps_id').textContent = data['4ps'] === 'Yes' ? data['4ps_id'] : '—';
    document.getElementById('m_disability').textContent =
        data.disability === 'Yes' ? 'Yes – ' + data.specific_disability : 'No';
    document.getElementById('m_birthcert').textContent = data.birth_cert_No;
    document.getElementById('m_birthplace').textContent = data.birth_place;

    const currAdd = [
        data.house_no ? 'No. ' + data.house_no : '',
        data.st_name, data.brgy, data.city, data.province, data.country,
        data.zip_code || ''
    ].filter(Boolean).join(', ');
    document.getElementById('m_curr_add').textContent = currAdd;

    const permAdd = data.perma_add === 'Yes' ? 'Same as current address' : [
        data.p_house_no ? 'No. ' + data.p_house_no : '',
        data.p_st_name, data.p_brgy, data.p_city, data.p_province, data.p_country,
        data.p_zip_code || ''
    ].filter(Boolean).join(', ');
    document.getElementById('m_perm_add').textContent = permAdd;

    document.getElementById('m_father').textContent =
        [data.father_Fname, data.father_Mname, data.father_Lname].filter(v => v && v !== '0').join(' ') || '—';
    document.getElementById('m_father_contact').textContent = data.father_contact || '—';
    document.getElementById('m_mother').textContent =
        [data.mother_Fname, data.mother_Mname, data.mother_Lname].filter(v => v && v !== '0').join(' ') || '—';
    document.getElementById('m_mother_contact').textContent = data.mother_contact || '—';
    document.getElementById('m_guardian').textContent =
        [data.guardian_Fname, data.guardian_Mname, data.guardian_Lname].filter(v => v && v !== '0').join(' ') || '—';
    document.getElementById('m_guardian_contact').textContent = data.guardian_contact || '—';

    document.getElementById('m_grade').textContent = data.grade_lvl;
    document.getElementById('m_track').textContent = data.track || '—';
    document.getElementById('m_pathway').textContent = data.pathway || '—';
    document.getElementById('m_sem').textContent = data.sem + ' Semester';
    document.getElementById('m_schyr').textContent = data.sch_yr;
    document.getElementById('m_modality').textContent = data.learning_modality;
    document.getElementById('m_lastgrade').textContent = 'Grade ' + data.last_gr_complete;
    document.getElementById('m_lastsch').textContent = data.last_sch_attend;
    document.getElementById('m_lastyr').textContent = data.last_yr_complete;
    document.getElementById('m_schid').textContent = data.sch_id;
    document.getElementById('m_withlrn').textContent = data.with_lrn;
    document.getElementById('m_returning').textContent = data.returning;
    document.getElementById('m_date').textContent = data.pre_enroll_date;

    document.getElementById('modalOverlay').classList.add('open');
}

function closeModal() {
    document.getElementById('modalOverlay').classList.remove('open');
}

function closeOnBackdrop(e) {
    if (e.target === document.getElementById('modalOverlay')) closeModal();
}

document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>

</body>
</html>
