<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Attendance Report</title>
     <style>
         /* GENERAL */
         @page { margin: 0px; }
         * {
             box-sizing: border-box;
         }

         body {
             font-family: DejaVu Sans, sans-serif;
             line-height: 1.4;
             color: #333;
         }

         .container {
             max-width: 900px;
             margin: 0 auto;
             padding: 12px;
         }
         /* HERO */
         header {
             display: flex;
             align-items: center;
             justify-content: space-around;
             position: relative;
             margin-bottom: 10px;
         }

         .header-logo {
             max-width: 300px;
             position: fixed;
             left: 10px;
             top: 2px;
             display: block;
         }

         .header-text {
             font-size: 1.3rem;
             padding-top: 20px;
             color: #333;
             text-align: center;
         }

         /* STUDENT */
         .student-section {
             margin-bottom: 10px;
             padding: 8px;
             background: #f9f9f9;
             border: 1px solid #ddd;
             border-radius: 5px;
             font-size: 0.9rem;
         }

         .student-section p {
             margin-bottom: 5px;
         }

         /* REPORT */
         .attendance-report h2 {
             text-align: center;
             margin-bottom: 10px;
             font-size: 1.2rem;
         }

         table {
             width: 100%;
             border-collapse: collapse;
             margin-bottom: 10px;
             font-size: 0.85rem;
         }

         table thead th {
             background-color: #d9534f;
             color: white;
             padding: 8px;
             text-align: left;
             font-size: 0.9rem;
         }

         table tbody td {
             padding: 6px;
             border: 1px solid #ddd;
             vertical-align: middle;
             text-align: left;
         }

         table tbody tr td[rowspan] {
             vertical-align: middle;
             background-color: #f9f9f9;
             font-weight: bold;
         }

         table tbody tr:nth-child(odd) {
             background: #f9f9f9;
         }

         table tbody tr:nth-child(even) {
             background: #fff;
         }

         /* FOOTER */
         footer {
             margin-top: 10px;
             padding: 10px 30px;
             border-top: none;
             background: none;
             font-size: 0.8rem;
         }

         .footer-container {
             display: flex;
             justify-content: space-between;
             align-items: center;
         }

         .footer-date {
             text-align: left;
         }

         .footer-date img {
             max-width: 100px;
             margin-top: 5px;
         }

         .footer-signature {
             text-align: right;
         }

         .footer-signature .signature-line {
             margin-top: 5px;
             font-style: italic;
             color: #333;
             text-align: right;
         }
     </style>
</head>
<body>
     <div class="container">
         <header>
             <div class="header-content">
                 <img src="./logo.png" alt="HZZ Logo" class="header-logo">
                 
             </div>
             
         </header>
         <h1 class="header-text">Pučko otvoreno učilište Zagreb</h1>

         <div class="student-section">
             <p><strong>Ime i prezime polaznika:</strong> {{
$studentData['student_name'] }}</p>
             <p><strong>OIB:</strong> {{ $studentData['oib'] }}</p>
             <p><strong>Naziv Programa:</strong> {{
$studentData['program'] }} - {{ $studentData['qualification'] }}</p>
             <p><strong>Trajanje obrazovnog programa:</strong> {{
$studentData['start_date'] }} - {{ $studentData['end_date'] }}</p>
         </div>

         <section class="attendance-report">
             <h2>Izvješće o pohađanju obrazovnog programa za mjesec {{
$studentData['report_month'] }}</h2>
             <table>
                 <thead>
                     <tr>
                         <th>Datum</th>
                         <th>Mjesto održavanja nastave</th>
                         <th>Broj sati</th>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($studentData['attendances'] as $attendance)
                         @if ($attendance['school'] &&
$attendance['school_hours'] && $attendance['company'] &&
$attendance['company_hours'])
                             <tr>
                                 <td rowspan="2">{{
$attendance['attendance_date'] }}</td>
<td><strong>Škola:</strong> {{ $attendance['school'] }}</td>
                                 <td>{{ $attendance['school_hours'] }}</td>
                             </tr>
                             <tr>
                             @if($studentData['location'])
                                    <td><strong>Praksa:</strong> {{ $attendance['company'] }}, {{$studentData['location']}}</td>  
                                @else
                                    <td><strong>Praksa:</strong> {{ $attendance['company'] }}</td>
                                @endif
                                 <td>{{ $attendance['company_hours'] }}</td>
                             </tr>
                         @elseif ($attendance['school'] &&
$attendance['school_hours'])
                             <tr>
                                 <td>{{ $attendance['attendance_date']
}}</td>
<td><strong>Škola:</strong> {{ $attendance['school'] }}</td>
                                 <td>{{ $attendance['school_hours'] }}</td>
                             </tr>
                         @elseif ($attendance['company'] &&
$attendance['company_hours'])
                             <tr>
                                 <td>{{ $attendance['attendance_date']
}}</td>
<td><strong>Praksa:</strong> {{ $attendance['company'] }}</td>
                                 <td>{{ $attendance['company_hours'] }}</td>
                             </tr>
                         @endif
                     @endforeach
                 </tbody>
             </table>
         </section>

         <footer>
             <div class="footer-container">
                 <div class="footer-date">
                     <p>U Zagrebu, {{ $studentData['today'] }}</p>
                     <img src="./eu.png" alt="EU Logo">
                 </div>
                 <div class="footer-signature">
                     <p>Kontrolirao:</p>
                     <p>{{ $studentData['principal'] }}</p>
                     <div
class="signature-line">________________________</div>
                 </div>
             </div>
         </footer>
     </div>
</body>
</html>