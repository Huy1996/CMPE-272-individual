<?php 
session_start();
include(dirname(__FILE__)."/config.php");
include BASE_PATH .'/header.php'; 
?>

    <h2>Careers at TechMasters Software Solutions</h2>
    <p>We are always looking for talented individuals to join our team. Check out our open positions below:</p>

    <h3>Open Positions</h3>
    <ul>
        <li><strong>Software Developer</strong> - Full-time<br>
            Requirements: Proficient in PHP, JavaScript, and MySQL. Experience with front-end frameworks like React is a plus.</li>
        <li><strong>DevOps Engineer</strong> - Full-time<br>
            Requirements: Experience with cloud platforms, CI/CD pipelines, and containerization (Docker, Kubernetes).</li>
        <li><strong>UX/UI Designer</strong> - Part-time<br>
            Requirements: Expertise in Adobe XD or Figma, and understanding of responsive design principles.</li>
    </ul>

    <p>If you are interested, please send your resume and cover letter to <a href="mailto:careers@techmasters.com">careers@techmasters.com</a>.</p>

<?php include BASE_PATH .'/footer.php'; ?>