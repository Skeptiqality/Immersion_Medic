<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-Enrollment Records</title>
    <link rel="icon" type="image/x-icon" href="../Pics/Logos/Lagro_High_School_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #f5f5f5;
            --surface: #ffffff;
            --border: #e0e0e0;
            --text: #1a1a1a;
            --muted: #555555;
            --accent: rgb(10, 89, 52);
            --accent-light: #e8f5e9;
            --row-hover: #e8f5e9;
            --shadow: 0 2px 5px rgba(0,0,0,0.4);
            --shadow-lg: 0 4px 8px rgba(0,0,0,0.15);
            --gradient: linear-gradient(90deg, rgb(10, 89, 52) 50%, rgb(55, 123, 77) 100%);
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
        }

        /* ── LAYOUT ── */
        .sidebar-container {
            flex-shrink: 0;
        }
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-x: hidden;
        }

        /* PAGE HEADER */
        .page-header { margin-bottom: 2rem; }
        .page-header h1 { font-size: 1.6rem; font-weight: 600; letter-spacing: -0.03em; }
        .page-header p { font-size: 0.85rem; color: var(--muted); margin-top: 0.25rem; }

        /* MAIN TABLE */
        .table-wrapper {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }
        thead th {
            background: var(--gradient);
            color: #fff;
            font-weight: 500;
            font-size: 0.75rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 0.85rem 1rem;
            text-align: left;
        }
        tbody tr { border-bottom: 1px solid var(--border); cursor: pointer; }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--row-hover); }
        tbody td { padding: 0.85rem 1rem; }
        tbody td.id-cell { font-family: 'DM Mono', monospace; font-size: 0.8rem; color: var(--muted); }

        /* BADGES */
        .badge { display: inline-block; padding: 0.2rem 0.55rem; border-radius: 20px; font-size: 0.73rem; font-weight: 500; }
        .badge-male   { background: #dbeafe; color: #1e40af; }
        .badge-female { background: #fce7f3; color: #9d174d; }
        .badge-grade  { background: var(--accent-light); color: var(--accent); }

        /* MODAL OVERLAY */
        .modal-overlay {
            visibility: hidden;
            opacity: 0;
            pointer-events: none;
            position: fixed;
            inset: 0;
            background: rgba(10,8,5,0.55);
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .modal-overlay.open {
            visibility: visible;
            opacity: 1;
            pointer-events: all;
        }

        /* MODAL BOX */
        .modal {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            width: 100%;
            max-width: 860px;
            max-height: 90vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-lg);
        }

        /* MODAL HEADER */
        .modal-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--gradient);
            color: #fff;
            flex-shrink: 0;
        }
        .modal-header-left { display: flex; flex-direction: column; gap: 0.2rem; }
        .modal-title { font-size: 1.1rem; font-weight: 600; letter-spacing: -0.02em; }
        .modal-subtitle { font-size: 0.75rem; opacity: 0.6; font-family: 'DM Mono', monospace; }
        .modal-close {
            background: rgba(255,255,255,0.12);
            border: none;
            color: #fff;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-close:hover { background: rgba(255,255,255,0.22); }

        /* MODAL BODY */
        .modal-body {
            overflow-y: auto;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* SECTION LABEL */
        .section-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .section-label::after { content: ''; flex: 1; height: 1px; background: var(--border); }

        /* INFO TABLES INSIDE MODAL */
        .info-table { width: 100%; border-collapse: collapse; font-size: 0.84rem; border: 1px solid var(--border); border-radius: 8px; overflow: hidden; }
        .info-table tr { border-bottom: 1px solid var(--border); }
        .info-table tr:last-child { border-bottom: none; }
        .info-table th { background: #f1f1f1; text-align: left; padding: 0.6rem 0.9rem; font-size: 0.75rem; font-weight: 500; color: var(--muted); width: 38%; vertical-align: top; }
        .info-table td { padding: 0.6rem 0.9rem; color: var(--text); }
        .mono { font-family: 'DM Mono', monospace; font-size: 0.8rem; color: var(--muted); }
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

<div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Applicant ID</th>
                <th>Full Name</th>
                <th>LRN</th>
                <th>Grade Level</th>
                <th>Sex</th>
                <th>Date Enrolled</th>
            </tr>
        </thead>
        <tbody>
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
                <td><strong><?= $fullName ?></strong></td>
                <td class="id-cell"><?= htmlspecialchars($row['lrn_id']) ?></td>
                <td><span class="badge badge-grade"><?= htmlspecialchars($row['grade_lvl']) ?></span></td>
                <td><span class="badge <?= $sexBadge ?>"><?= htmlspecialchars($row['sex']) ?></span></td>
                <td><?= htmlspecialchars($row['pre_enroll_date']) ?></td>
            </tr>
        <?php
            endwhile;
        endif;
        ?>
        </tbody>
    </table>
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