<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DENTAL CERTIFICATE</title>

    <style>
        
        body {
            padding: 10px;
            font-size: 0.8rem;
        }
        .header {
            width: 100%;
            text-align: center;
        }
        .logo {
            position: absolute;
            left: 0;
            top: 0;
            margin: 0 0 0 10px;
        }
        .line-thick {
            height: 3px; 
            background: black; 
            margin: 10px 0;
        }
        .line-thin {
            height: 1px; 
            background: black; 
            margin: 10px 0;
        }
        .date {
            width: 100%;
            text-align: right;
            margin-top: 10px;
        }
        .input-bottom {
            outline: none;
            border: none;
            border-bottom: 1px solid black;
            padding-left: 3px;
        }
        .input-checkbox {
            width: auto;
        }
        .letter-body {
            text-indent: 30px;
            margin-top: 10px;
        }
        .checkbox-category {
            /* text-indent: 50px; */
        }
        .category-item {
            text-indent: 50px;
            padding: 0;
            margin: 0 0 0 50px;
        }
        .letter-footer {
            text-indent: 30px;
            margin-top: 10px;
        }
        .letter-signature {
            display: flex;
            justify-content: end;
            align-items: center;
            margin-top: 10px;
        }
        .text-center {
            text-align: center;
        }
        .student-copy, .original-copy {
            position: relative;
        }
        .footer-copy {
            position: absolute;
            bottom: 0;
            left: 0;
            font-size: 0.8rem;
        }

    </style>
</head>
<body >
    <div class="student-copy">
        <div class="header">
            <div>Republic of the Philippines</div>
            <div><b>CENTRAL BICOL STATE UNIVERSITY OF AGRICULTURE</b></div>
            <div>Impig, Sipocot, Camarines Sur - 4408</div>
            <div><i>Website: <a href="www.cbsua.edu.ph" target="_blank">www.cbsua.edu.ph</a></i></div>
            <div><i>Email Address: <a href="cbsua.sipocot@cbsua.edu.ph" target="_blank">cbsua.sipocot@cbsua.edu.ph</a></i></div>
            <div><i>Trunkline: (054) 881-6681</i></div>
        </div>
        <div class="logo">
            <img src="<?= base_url('assets/images/modules/bsu-logo.png') ?>"
                width="90" width="90">
        </div>
        <div class="line-thick"></div>
        <div class="header">
            <b>DENTAL CERTIFICATE</b>
        </div>
        <div class="date">
            <span>DATE: </span>
            <input type="text" class="input-bottom" value="<?= date('F d, Y', strtotime($information->date_header)) ?>">
        </div>
        <div>To Whom It May Concern:</div>
        <div class="letter-body">
            This is to certify that <b>MR./MS.<input type="text" class="input-bottom" value="<?= $information->fullname ?? "-" ?>" style="width: 250px;"></b>, <input type="text" class="input-bottom" value="<?= $information->age ?? "-" ?>" style="width: 50px;"> years old, <b>MALE/ FEMALE</b>, presently residing at <b><input type="text" class="input-bottom" value="<?= $information->address ?? "-" ?>" style="width: 200px;"></b> reported to the undersigned for:
        </div>
        <div class="checkbox-category">
            󠇯<span class="category-item"><input type="checkbox" <?= $information->sign_name=="sign1" ? "checked" : "" ?> disabled>Routine check-up and Mouth Examination </span><br>
            󠇯<span class="category-item"><input type="checkbox" <?= $information->sign_name=="sign2" ? "checked" : "" ?> disabled>Surgical removal or tooth extraction of Tooth # <input type="text" class="input-bottom input-checkbox" value="<?= $information->sign_name=="sign2" ? $information->sign_note : "" ?>"></span><br>
            󠇯<span class="category-item"><input type="checkbox" <?= $information->sign_name=="sign3" ? "checked" : "" ?> disabled>Restorations of Tooth # <input type="text" class="input-bottom input-checkbox" value="<?= $information->sign_name=="sign3" ? $information->sign_note : "" ?>"></span><br>
            󠇯<span class="category-item"><input type="checkbox" <?= $information->sign_name=="sign4" ? "checked" : "" ?> disabled>Oral Prophylaxis󠇯</span><br>
            󠇯<span class="category-item"><input type="checkbox" <?= $information->sign_name=="sign5" ? "checked" : "" ?> disabled>Others: <input type="text" class="input-bottom input-checkbox" value="<?= $information->sign_name=="sign5" ? $information->sign_note : "" ?>"></span>
        </div>
        <div class="recommendation">
            <b>Comment/Recommendation:</b>
        </div>
        <div class="checkbox-category">
            <span class="category-item"><input type="checkbox" <?= $information->comment_name=="comment1" ? "checked" : "" ?> disabled>󠇯Fit to engage university academic and non- academic activity </span><br>
            󠇯<span class="category-item"><input type="checkbox" <?= $information->comment_name=="comment2" ? "checked" : "" ?> disabled>Rest and Medication for  <input type="text" class="input-bottom input-checkbox" value="<?= $information->comment_name=="comment2" ? $information->comment_note : "" ?>"></span><br>
            󠇯<span class="category-item"><input type="checkbox" <?= $information->comment_name=="comment3" ? "checked" : "" ?> disabled>󠇯Others: <input type="text" class="input-bottom input-checkbox" value="<?= $information->comment_name=="comment3" ? $information->comment_note : "" ?>"></span><br>
        </div>
        <div class="letter-footer">
            This certification is issued upon request for the aforementioned for record and references purposes. Given this <input type="text" class="input-bottom" style="width: 100px;" value="<?= date('F', strtotime($information->date_given)) ?>"> day of <input type="text" class="input-bottom" style="width: 50px;" value="<?= date('d', strtotime($information->date_given)) ?>">, 20<input type="text" class="input-bottom" style="width: 50px;" value="<?= date('y', strtotime($information->date_given)) ?>">.
        </div>
        <div class="letter-signature">
            <div class="text-center">
                <div><b>JOAN A. ARCILLA, DMD, MIH</b></div>
                <div>Lic. No.  32920</div>
                <div>University Dentist</div>
            </div>
        </div>
        <div class="footer-copy">Student's Copy</div>
    </div>
    <div class="line-thin"></div>
    <div class="original-copy">
        <div class="header">
            <div>Republic of the Philippines</div>
            <div><b>CENTRAL BICOL STATE UNIVERSITY OF AGRICULTURE</b></div>
            <div>Impig, Sipocot, Camarines Sur - 4408</div>
            <div><i>Website: <a href="www.cbsua.edu.ph" target="_blank">www.cbsua.edu.ph</a></i></div>
            <div><i>Email Address: <a href="cbsua.sipocot@cbsua.edu.ph" target="_blank">cbsua.sipocot@cbsua.edu.ph</a></i></div>
            <div><i>Trunkline: (054) 881-6681</i></div>
        </div>
        <div class="logo">
            <img src="<?= base_url('assets/images/modules/bsu-logo.png') ?>"
                width="90" width="90">
        </div>
        <div class="line-thick"></div>
        <div class="header">
            <b>DENTAL CERTIFICATE</b>
        </div>
        <div class="date">
            <span>DATE: </span>
            <input type="text" class="input-bottom" value="<?= date('F d, Y', strtotime($information->date_header)) ?>">
        </div>
        <div>To Whom It May Concern:</div>
        <div class="letter-body">
            This is to certify that <b>MR./MS.<input type="text" class="input-bottom" value="<?= $information->fullname ?? "-" ?>" style="width: 250px;"></b>, <input type="text" class="input-bottom" value="<?= $information->gender ?? "-" ?>" style="width: 50px;"> years old, <b>MALE/ FEMALE</b>, presently residing at <b><input type="text" class="input-bottom" value="<?= $information->address ?? "-" ?>" style="width: 200px;"></b> reported to the undersigned for:
        </div>
        <div class="checkbox-category">
            󠇯<span class="category-item"><input type="checkbox" <?= $information->sign_name=="sign1" ? "checked" : "" ?> disabled>Routine check-up and Mouth Examination </span><br>
            󠇯<span class="category-item"><input type="checkbox" <?= $information->sign_name=="sign2" ? "checked" : "" ?> disabled>Surgical removal or tooth extraction of Tooth # <input type="text" class="input-bottom input-checkbox" value="<?= $information->sign_name=="sign2" ? $information->sign_note : "" ?>"></span><br>
            󠇯<span class="category-item"><input type="checkbox" <?= $information->sign_name=="sign3" ? "checked" : "" ?> disabled>Restorations of Tooth # <input type="text" class="input-bottom input-checkbox" value="<?= $information->sign_name=="sign3" ? $information->sign_note : "" ?>"></span><br>
            󠇯<span class="category-item"><input type="checkbox" <?= $information->sign_name=="sign4" ? "checked" : "" ?> disabled>Oral Prophylaxis󠇯</span><br>
            󠇯<span class="category-item"><input type="checkbox" <?= $information->sign_name=="sign5" ? "checked" : "" ?> disabled>Others: <input type="text" class="input-bottom input-checkbox" value="<?= $information->sign_name=="sign5" ? $information->sign_note : "" ?>"></span>
        </div>
        <div class="recommendation">
            <b>Comment/Recommendation:</b>
        </div>
        <div class="checkbox-category">
            <span class="category-item"><input type="checkbox" <?= $information->comment_name=="comment1" ? "checked" : "" ?> disabled>󠇯Fit to engage university academic and non- academic activity </span><br>
            󠇯<span class="category-item"><input type="checkbox" <?= $information->comment_name=="comment2" ? "checked" : "" ?> disabled>Rest and Medication for  <input type="text" class="input-bottom input-checkbox" value="<?= $information->comment_name=="comment2" ? $information->comment_note : "" ?>"></span><br>
            󠇯<span class="category-item"><input type="checkbox" <?= $information->comment_name=="comment3" ? "checked" : "" ?> disabled>󠇯Others: <input type="text" class="input-bottom input-checkbox" value="<?= $information->comment_name=="comment3" ? $information->comment_note : "" ?>"></span><br>
        </div>
        <div class="letter-footer">
            This certification is issued upon request for the aforementioned for record and references purposes. Given this <input type="text" class="input-bottom" style="width: 100px;" value="<?= date('F', strtotime($information->date_given)) ?>"> day of <input type="text" class="input-bottom" style="width: 50px;" value="<?= date('d', strtotime($information->date_given)) ?>">, 20<input type="text" class="input-bottom" style="width: 50px;" value="<?= date('y', strtotime($information->date_given)) ?>">.
        </div>
        <div class="letter-signature">
            <div class="text-center">
                <div><b>JOAN A. ARCILLA, DMD, MIH</b></div>
                <div>Lic. No.  32920</div>
                <div>University Dentist</div>
            </div>
        </div>
        <div class="footer-copy">File Copy</div>
    </div>

    <script>window.print();</script>
</body>
</html>