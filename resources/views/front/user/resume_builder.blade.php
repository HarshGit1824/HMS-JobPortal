<!DOCTYPE html>
<html lang="en">
<head>
    <title>Resume Builder</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}"> 
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/resume.css') }}">
    <style>
        /* Existing CSS styles */
        .hidden { display: none; }
    </style>
</head>
<body>
    @include('front.layouts.header')
    <div class="section">
        <h1>Resume Builder</h1>
        <h2>Personal Information</h2>
        <div class="profile-picture">
            <label for="profile-image">Profile Picture:</label>
            @if(Auth::user()->image !='')
                <img src="{{ asset('profile_pic/thumb/'.Auth::user()->image) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            @else
                <img src="{{ asset('assets/images/avatar7.png') }}" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
            @endif            
        </div>
        <label for="name">Name:</label>
        <input type="text" id="name" value="{{ $user->name }}"><br>
        <label for="city">Address:</label>
        <input type="text" id="city" value="{{ $user->address }}"><br>
        <label for="email">Email:</label>
        <input type="email" id="email" value="{{ $user->email }}"><br>
        <label for="contact">Contact No:</label>
        <input type="text" id="contact" value="{{ $user->mobile }}">
    </div>
    <div class="section">
        <h2>Summary</h2>
        <textarea id="summary" rows="4" cols="50">{{ $user->summary }}</textarea>
    </div>
    <div class="section">
        <h2>Experience</h2>
        <hr>    
        @if($experiences->isNotEmpty())
            @foreach($experiences as $experience)
            <div class="mb-4">
                <h6>Role : {{ $experience->role }}</h6>
                <p><b>Company : </b>{{ $experience->company }}</p>
                <p><b>Employment Type : </b>{{ $experience->emp_type }}</p>
                <p><b>Location : </b>{{ $experience->location }}</p>
                <p><b>Location Type : </b>{{ $experience->location_type }}</p>
                <p><b>Duration : </b>{{ $experience->start_date }} <b>-</b> {{ $experience->end_date }}</p>
                <p><b>Description : </b>{{ $experience->description }}</p>
            </div>
            <hr>
            @endforeach
        @else
            <p>No experience information added yet.</p>
        @endif
    </div>
    <div class="section">
        <h2>Education</h2>
        <hr>
        @if($education->isNotEmpty())
            @foreach($education as $edu)
            <div class="mb-4">
                <h6>Degree : {{ $edu->degree }}</h6>
                <p><b>Institution : </b>{{ $edu->institution }}</p>
                <p><b>Start Date : </b>{{ $edu->start_date }}</p>
                <p><b>End Date : </b>{{ $edu->end_date }}</p>
                <p><b>Grade/Percentage : </b>{{ $edu->gradepercentage }}</p>
            </div>
            <hr>
            @endforeach
        @else
            <p>No education information added yet.</p>
        @endif
    </div>
    <div class="section">
        <h2>Skills</h2>
        <textarea id="skills" rows="4" cols="50">{{ $user->skills }}</textarea>
    </div>
    
    <div class="section">
        <h2>Honor and awards</h2>
        <textarea id="honorsndawards" rows="4" cols="50">{{ $user->updateHonorsNdAwards }}</textarea>
    </div>

    <div class="section">
        <h2>Projects</h2>
        @if($projects->isNotEmpty())
            @foreach($projects as $project)
                <div class="mb-4">
                    <h5>{{ $project->project_name }}</h5>
                    <p><b>Start Date: </b>{{ $project->start_date }}</p>
                    <p><b>End Date: </b>{{ $project->end_date }}</p>
                    <p><b>Technology and Software Used: </b>{{ $project->technologies }}</p>
                    <p><b>Description: </b>{{ $project->description }}</p>
                </div>
                <hr>
            @endforeach
        @else
            <p>No projects added yet.</p>
        @endif    
    </div>
        <div class="section">
            <h2>Select contents which displaying in your resume.</h2>
        <input type="checkbox" id="personal-info-checkbox" checked>
        <label for="personal-info-checkbox">Personal Information</label><br>
        <input type="checkbox" id="summary-checkbox" checked>
        <label for="summary-checkbox">Summary</label><br>
        <input type="checkbox" id="experience-checkbox" checked>
        <label for="experience-checkbox">Experience</label><br>
        <input type="checkbox" id="education-checkbox" checked>
        <label for="education-checkbox">Education</label><br>
        <input type="checkbox" id="skills-checkbox" checked>
        <label for="skills-checkbox">Skills</label><br>
        <input type="checkbox" id="honors-awards-checkbox" checked>
        <label for="honors-awards-checkbox">Honors and Awards</label><br>
        <input type="checkbox" id="projects-checkbox" checked>
        <label for="projects-checkbox">Projects</label><br>
    </div>
    <div class="section">
        <button id="generate-resume" onclick="generateResume()">Generate Resume</button>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="resume-content"></div>
        </div>
    </div>
    <div class="section">
        <button id="download-button" class="hidden" onclick="downloadResume()">Download Resume</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

    <script>
        function generateResume() {
            const personalInfoCheckbox = document.getElementById('personal-info-checkbox');
            const summaryCheckbox = document.getElementById('summary-checkbox');
            const experienceCheckbox = document.getElementById('experience-checkbox');
            const educationCheckbox = document.getElementById('education-checkbox');
            const skillsCheckbox = document.getElementById('skills-checkbox');
            const honorsAwardsCheckbox = document.getElementById('honors-awards-checkbox');
            const projectsCheckbox = document.getElementById('projects-checkbox');

            const name = document.getElementById('name').value;
            const city = document.getElementById('city').value;
            const email = document.getElementById('email').value;
            const contact = document.getElementById('contact').value;
            const summary = document.getElementById('summary').value;
            const skills = document.getElementById('skills').value;
            const honorsndawards = document.getElementById('honorsndawards').value;
            const profileImage = document.querySelector('.profile-picture img').src;

            const experiences = @json($experiences);
            const educationData = @json($education);
            const projectsData = @json($projects);

            let selectedSections = [];

            if (personalInfoCheckbox.checked) {
                selectedSections.push({
                    type: 'personal-info',
                    name: name,
                    city: city,
                    email: email,
                    contact: contact,
                    profileImage: profileImage,
                });
            }

            if (summaryCheckbox.checked) {
                selectedSections.push({
                    type: 'summary',
                    content: summary,
                });
            }

            if (experienceCheckbox.checked) {
                selectedSections.push({
                    type: 'experience',
                    content: experiences,
                });
            }

            if (educationCheckbox.checked) {
                selectedSections.push({
                    type: 'education',
                    content: educationData,
                });
            }

            if (skillsCheckbox.checked) {
                selectedSections.push({
                    type: 'skills',
                    content: skills,
                });
            }

            if (honorsAwardsCheckbox.checked) {
                selectedSections.push({
                    type: 'honors-awards',
                    content: honorsndawards,
                });
            }

            if (projectsCheckbox.checked) {
                selectedSections.push({
                    type: 'projects',
                    content: projectsData,
                });
            }

            let resumeContent = '';

            selectedSections.forEach(section => {
                switch (section.type) {
                    case 'personal-info':
                        resumeContent += `
                            <div class="section">
                                <h2>Personal Information</h2>
                                <div class="profile-picture">
                                    <img src="${section.profileImage}" alt="Profile Image" class="profile-image">
                                </div>
                                <p><strong>Name:</strong> ${section.name}</p>
                                <p><strong>Address:</strong> ${section.city}</p>
                                <p><strong>Email:</strong> ${section.email}</p>
                                <p><strong>Contact No:</strong> ${section.contact}</p>
                            </div>
                        `;
                        break;
                    case 'summary':
                        resumeContent += `
                            <div class="section">
                                <h2>Summary</h2>
                                <p>${section.content}</p>
                            </div>
                        `;
                        break;
                    case 'experience':
                        resumeContent += '<div class="section"><h2>Experience</h2>';
                        section.content.forEach(experience => {
                            resumeContent += `
                                <div class="mb-4">
                                    <h6>Role: ${experience.role}</h6>
                                    <p><strong>Company:</strong> ${experience.company}</p>
                                    <p><strong>Employment Type:</strong> ${experience.emp_type}</p>
                                    <p><strong>Location:</strong> ${experience.location}</p>
                                    <p><strong>Location Type:</strong> ${experience.location_type}</p>
                                    <p><strong>Duration:</strong> ${experience.start_date} - ${experience.end_date}</p>
                                    <p><strong>Description:</strong> ${experience.description}</p>
                                </div>
                                <hr>
                            `;
                        });
                        resumeContent += '</div>';
                        break;
                    case 'education':
                        resumeContent += '<div class="section"><h2>Education</h2>';
                        section.content.forEach(education => {
                            resumeContent += `
                                <div class="mb-4">
                                    <h6>Degree: ${education.degree}</h6>
                                    <p><strong>Institution:</strong> ${education.institution}</p>
                                    <p><strong>Start Date:</strong> ${education.start_date}</p>
                                    <p><strong>End Date:</strong> ${education.end_date}</p>
                                    <p><strong>Grade/Percentage:</strong> ${education.gradepercentage}</p>
                                </div>
                                <hr>
                            `;
                        });
                        resumeContent += '</div>';
                        break;
                    case 'skills':
                        resumeContent += `
                            <div class="section">
                                <h2>Skills</h2>
                                <p>${section.content}</p>
                            </div>
                        `;
                        break;
                    case 'honors-awards':
                        resumeContent += `
                            <div class="section">
                                <h2>Honors and Awards</h2>
                                <p>${section.content}</p>
                            </div>
                        `;
                        break;
                    case 'projects':
                        resumeContent += '<div class="section"><h2>Projects</h2>';
                        section.content.forEach(project => {
                            resumeContent += `
                                <div class="mb-4">
                                    <h5>${project.project_name}</h5>
                                    <p><strong>Start Date:</strong> ${project.start_date}</p>
                                    <p><strong>End Date:</strong> ${project.end_date}</p>
                                    <p><strong>Technology and Software Used:</strong> ${project.technologies}</p>
                                    <p><strong>Description:</strong> ${project.description}</p>
                                </div>
                                <hr>
                            `;
                        });
                        resumeContent += '</div>';
                        break;
                    default:
                        break;
                }
            });

            const resumeContainer = document.getElementById('resume-content');
            resumeContainer.innerHTML = resumeContent;

            const modal = document.getElementById('myModal');
            const closeButton = document.getElementsByClassName('close')[0];
            modal.style.display = 'block';

            closeButton.onclick = function() {
                modal.style.display = 'none';
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            }

            // Display the download button
            document.getElementById('download-button').classList.remove('hidden');
        }

        function downloadResume() {
        const element = document.getElementById('resume-content');
        const opt = {
            margin: 0.5,
            filename: 'resume.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2, logging: true, dpi: 192, letterRendering: true },
            jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
        };

        // Start the PDF generation process
        html2pdf().set(opt).from(element).toPdf().get('pdf').then(function(pdf) {
            // Download the PDF
            pdf.save();
        });
    }

    </script>
</body>
</html>
