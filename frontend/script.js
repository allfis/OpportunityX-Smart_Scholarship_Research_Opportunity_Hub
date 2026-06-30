/* ===== OpportunityX - Main App Logic ===== */

// ===== DATA =====
const OPPORTUNITIES = [
  {
    id: 1,
    type: "Scholarship",
    title: "Fulbright Foreign Student Program",
    org: "US Department of State",
    field: "Computer Science",
    country: "USA",
    amount: "$30,000",
    deadline: "2025-03-15",
    desc: "Fully funded scholarship for graduate students to study in the USA. Covers tuition, living expenses, and travel.",
  },
  {
    id: 2,
    type: "Research Grant",
    title: "NSF Graduate Research Fellowship",
    org: "National Science Foundation",
    field: "Physics",
    country: "USA",
    amount: "$50,000",
    deadline: "2025-02-28",
    desc: "Supports outstanding graduate students in STEM fields. Three years of funding for research.",
  },
  {
    id: 3,
    type: "Fellowship",
    title: "Google PhD Fellowship Program",
    org: "Google",
    field: "Computer Science",
    country: "USA",
    amount: "$40,000",
    deadline: "2025-04-01",
    desc: "For exceptional PhD students in computer science and related disciplines. Includes mentorship from Google researchers.",
  },
  {
    id: 4,
    type: "Internship",
    title: "Microsoft Research Internship",
    org: "Microsoft",
    field: "Computer Science",
    country: "USA",
    amount: "$8,000/mo",
    deadline: "2025-01-31",
    desc: "12-week research internship at Microsoft Research labs. Work on cutting-edge AI and systems projects.",
  },
  {
    id: 5,
    type: "Scholarship",
    title: "DAAD Scholarship Program",
    org: "DAAD",
    field: "Engineering",
    country: "Germany",
    amount: "$25,000",
    deadline: "2025-05-15",
    desc: "German Academic Exchange Service scholarship for international students. Covers tuition and monthly stipend.",
  },
  {
    id: 6,
    type: "Competition",
    title: "NASA Space Apps Challenge",
    org: "NASA",
    field: "Engineering",
    country: "USA",
    amount: "$10,000",
    deadline: "2025-02-10",
    desc: "International hackathon leveraging NASA data. Teams compete to solve real-world space challenges.",
  },
  {
    id: 7,
    type: "Fellowship",
    title: "Chevening Scholarship",
    org: "UK Government",
    field: "Business",
    country: "UK",
    amount: "$35,000",
    deadline: "2025-03-01",
    desc: "Fully funded one-year master's degree in the UK for future leaders and decision-makers.",
  },
  {
    id: 8,
    type: "Research Grant",
    title: "WHO Research Grant",
    org: "World Health Organization",
    field: "Medical Science",
    country: "Bangladesh",
    amount: "$20,000",
    deadline: "2025-04-20",
    desc: "Funding for health research projects in developing countries. Focus on public health interventions.",
  },
  {
    id: 9,
    type: "Scholarship",
    title: "MEXT Scholarship Japan",
    org: "Japanese Government",
    field: "Physics",
    country: "Japan",
    amount: "$22,000",
    deadline: "2025-05-30",
    desc: "Full scholarship for undergraduate and graduate studies in Japan. Includes tuition, accommodation, and allowance.",
  },
  {
    id: 10,
    type: "Internship",
    title: "DeepMind Research Intern",
    org: "Google DeepMind",
    field: "Computer Science",
    country: "UK",
    amount: "$10,000/mo",
    deadline: "2025-02-15",
    desc: "Work alongside world-class researchers on fundamental AI problems. 3-6 month positions available.",
  },
  {
    id: 11,
    type: "Research Grant",
    title: "Bangladesh NSST Research Fund",
    org: "NST",
    field: "Engineering",
    country: "Bangladesh",
    amount: "$5,000",
    deadline: "2025-06-01",
    desc: "National science and technology research fund for Bangladeshi researchers in engineering fields.",
  },
  {
    id: 12,
    type: "Fellowship",
    title: "MIT Media Lab Fellowship",
    org: "MIT",
    field: "Computer Science",
    country: "USA",
    amount: "$60,000",
    deadline: "2025-03-20",
    desc: "Work at the intersection of technology, multimedia, science, art, and design at MIT Media Lab.",
  },
];

const FEATURES = [
  {
    icon: "fa-search",
    bg: "var(--sky-100)",
    color: "var(--sky-600)",
    title: "Smart Search",
    desc: "Find opportunities matching your profile using AI-powered search filters.",
  },
  {
    icon: "fa-bell",
    bg: "#fef3c7",
    color: "#d97706",
    title: "Deadline Alerts",
    desc: "Get timely notifications before application deadlines to never miss out.",
  },
  {
    icon: "fa-check-circle",
    bg: "#d1fae5",
    color: "#059669",
    title: "Eligibility Checker",
    desc: "Instantly verify if you meet the criteria before spending hours applying.",
  },
  {
    icon: "fa-columns",
    bg: "#ede9fe",
    color: "#7c3aed",
    title: "Application Tracker",
    desc: "Track all your applications in a kanban board from start to acceptance.",
  },
  {
    icon: "fa-chalkboard-teacher",
    bg: "#fce7f3",
    color: "#be185d",
    title: "Faculty Posting",
    desc: "Faculty members can directly post opportunities for their students.",
  },
  {
    icon: "fa-bookmark",
    bg: "#dbeafe",
    color: "#2563eb",
    title: "Save & Bookmark",
    desc: "Bookmark opportunities you like and come back to apply later.",
  },
  {
    icon: "fa-globe",
    bg: "#e0e7ff",
    color: "#4f46e5",
    title: "Global Coverage",
    desc: "Opportunities from 50+ countries including USA, UK, Germany, Japan.",
  },
  {
    icon: "fa-chart-line",
    bg: "#f0fdf4",
    color: "#16a34a",
    title: "Success Analytics",
    desc: "See acceptance rates, average GPAs, and tips for each opportunity.",
  },
];

const TICKER_DATA = [
  { name: "Fulbright Program", amt: "$30,000", color: "#1d4ed8" },
  { name: "NSF Grant", amt: "$50,000", color: "#047857" },
  { name: "Google Fellowship", amt: "$40,000", color: "#6d28d9" },
  { name: "DAAD Scholarship", amt: "$25,000", color: "#1d4ed8" },
  { name: "Chevening UK", amt: "$35,000", color: "#6d28d9" },
  { name: "MEXT Japan", amt: "$22,000", color: "#1d4ed8" },
  { name: "MIT Fellowship", amt: "$60,000", color: "#6d28d9" },
  { name: "DeepMind Intern", amt: "$10,000/mo", color: "#b45309" },
  { name: "NASA Space Apps", amt: "$10,000", color: "#be185d" },
  { name: "WHO Research", amt: "$20,000", color: "#047857" },
];

let trackerData = {
  applied: [
    { name: "Fulbright Program", date: "Jan 15, 2025" },
    { name: "DAAD Scholarship", date: "Jan 20, 2025" },
    { name: "NSF Fellowship", date: "Jan 22, 2025" },
  ],
  review: [
    { name: "Chevening UK", date: "Jan 10, 2025" },
    { name: "Google PhD Fellowship", date: "Jan 18, 2025" },
  ],
  shortlisted: [{ name: "MEXT Japan", date: "Jan 5, 2025" }],
  accepted: [{ name: "NASA Space Apps", date: "Dec 28, 2024" }],
};

let activeTab = "All";
let bookmarked = new Set();

// ===== HERO ANIMATIONS =====
(function initHeroTitle() {
  const words = [
    { text: "Your", hl: false },
    { text: "Next", hl: false },
    { text: "Academic", hl: true },
    { text: "Opportunity", hl: true },
    { text: "Starts", hl: false },
    { text: "Here", hl: false },
  ];
  const el = document.getElementById("heroTitle");
  el.innerHTML = words
    .map(
      (w, i) =>
        '<span class="word" style="animation-delay:' +
        (0.4 + i * 0.12) +
        's">' +
        (w.hl ? '<span class="hl">' + w.text + "</span>" : w.text) +
        "</span> ",
    )
    .join("");
})();

(function initTyping() {
  const phrases = [
    "Looking for scholarships?",
    "Need a research grant?",
    "Apply for fellowships",
    "Find international internships",
    "Join global hackathons",
  ];
  const el = document.getElementById("typingText");
  let pi = 0,
    ci = 0,
    deleting = false,
    delay = 2000;

  function type() {
    const cur = phrases[pi];
    if (!deleting) {
      el.textContent = cur.substring(0, ci + 1);
      ci++;
      if (ci === cur.length) {
        deleting = true;
        delay = 1800;
      } else delay = 60 + Math.random() * 40;
    } else {
      el.textContent = cur.substring(0, ci - 1);
      ci--;
      if (ci === 0) {
        deleting = false;
        pi = (pi + 1) % phrases.length;
        delay = 400;
      } else delay = 30;
    }
    setTimeout(type, delay);
  }
  setTimeout(type, 1800);
})();

// ===== SPOTLIGHT =====
document.querySelector(".hero").addEventListener("mousemove", function (e) {
  const sl = document.getElementById("spotlight");
  sl.style.left = e.clientX + "px";
  sl.style.top = e.clientY + "px";
});

// ===== NAVBAR SCROLL =====
window.addEventListener("scroll", function () {
  const nb = document.getElementById("navbar");
  nb.classList.toggle("scrolled", window.scrollY > 50);
});

// ===== MOBILE MENU =====
document.getElementById("mobToggle").addEventListener("click", function () {
  document.getElementById("mobMenu").classList.toggle("open");
});
document.querySelectorAll("#mobMenu a").forEach(function (a) {
  a.addEventListener("click", function () {
    document.getElementById("mobMenu").classList.remove("open");
  });
});

// ===== ACTIVE NAV LINK =====
const sections = document.querySelectorAll("section[id]");
window.addEventListener("scroll", function () {
  let current = "";
  sections.forEach(function (sec) {
    const top = sec.offsetTop - 100;
    if (window.scrollY >= top) current = sec.getAttribute("id");
  });
  document.querySelectorAll(".nav-links a").forEach(function (a) {
    a.classList.remove("active");
    if (a.getAttribute("href") === "#" + current) a.classList.add("active");
  });
});

// ===== TOAST =====
function showToast(msg, type) {
  type = type || "info";
  var tc = document.getElementById("toastC");
  var t = document.createElement("div");
  t.className = "toast " + type;
  var icons = {
    success: "fa-check-circle",
    error: "fa-exclamation-circle",
    info: "fa-info-circle",
  };
  t.innerHTML =
    '<i class="fas ' +
    (icons[type] || icons.info) +
    '" style="color:var(--' +
    (type === "success" ? "green" : type === "error" ? "red" : "sky-500") +
    ');font-size:18px"></i>' +
    msg;
  tc.appendChild(t);
  setTimeout(function () {
    t.style.animation = "tOut .3s forwards";
    setTimeout(function () {
      t.remove();
    }, 300);
  }, 3000);
}

// ===== TICKER =====
(function initTicker() {
  var track = document.getElementById("tickerTrack");
  var html = "";
  var items = TICKER_DATA.map(function (d) {
    return (
      '<div class="ticker-item"><span class="ti-dot" style="background:' +
      d.color +
      '"></span>' +
      d.name +
      ' — <span class="ti-amt">' +
      d.amt +
      "</span></div>"
    );
  }).join("");
  track.innerHTML = items + items; // duplicate for seamless loop
})();

// ===== STATS COUNTER =====
function animateStats() {
  document.querySelectorAll(".stat-number").forEach(function (el) {
    var target = parseInt(el.getAttribute("data-count"));
    var duration = 2000;
    var start = 0;
    var startTime = null;
    function step(ts) {
      if (!startTime) startTime = ts;
      var progress = Math.min((ts - startTime) / duration, 1);
      var eased = 1 - Math.pow(1 - progress, 3);
      el.textContent = Math.floor(eased * target).toLocaleString();
      if (progress < 1) requestAnimationFrame(step);
      else el.textContent = target.toLocaleString();
    }
    requestAnimationFrame(step);
  });
}

// ===== FEATURES =====
(function renderFeatures() {
  var grid = document.getElementById("featGrid");
  grid.innerHTML = FEATURES.map(function (f) {
    return (
      '<div class="feature-card fade-up"><div class="feature-icon" style="background:' +
      f.bg +
      ";color:" +
      f.color +
      '"><i class="fas ' +
      f.icon +
      '"></i></div><h3>' +
      f.title +
      "</h3><p>" +
      f.desc +
      "</p></div>"
    );
  }).join("");
})();

// ===== OPPORTUNITIES =====
var typeMap = {
  Scholarship: { cls: "b-sch", fc: "fc-sch" },
  "Research Grant": { cls: "b-grant", fc: "fc-grant" },
  Fellowship: { cls: "b-fel", fc: "fc-fel" },
  Internship: { cls: "b-int", fc: "fc-int" },
  Competition: { cls: "b-comp", fc: "fc-comp" },
};

function getDeadlineClass(dl) {
  var days = Math.ceil((new Date(dl) - new Date()) / 86400000);
  if (days <= 7) return "dl-urg";
  if (days <= 21) return "dl-soon";
  return "dl-norm";
}

function getDeadlineText(dl) {
  var days = Math.ceil((new Date(dl) - new Date()) / 86400000);
  if (days <= 0) return "Closed";
  if (days === 1) return "1 day left";
  return days + " days left";
}

function renderTabs() {
  var types = [
    "All",
    "Scholarship",
    "Research Grant",
    "Fellowship",
    "Internship",
    "Competition",
  ];
  var tabs = document.getElementById("oppTabs");
  tabs.innerHTML = types
    .map(function (t) {
      return (
        '<button class="tab-btn' +
        (t === activeTab ? " active" : "") +
        '" data-tab="' +
        t +
        '">' +
        t +
        "</button>"
      );
    })
    .join("");
  tabs.querySelectorAll(".tab-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      activeTab = this.getAttribute("data-tab");
      renderTabs();
      renderOpportunities();
    });
  });
}

function renderOpportunities() {
  var grid = document.getElementById("oppGrid");
  var search = document.getElementById("searchIn").value.toLowerCase();
  var field = document.getElementById("fieldFil").value;
  var country = document.getElementById("countryFil").value;

  var filtered = OPPORTUNITIES.filter(function (o) {
    if (activeTab !== "All" && o.type !== activeTab) return false;
    if (
      search &&
      o.title.toLowerCase().indexOf(search) === -1 &&
      o.org.toLowerCase().indexOf(search) === -1 &&
      o.desc.toLowerCase().indexOf(search) === -1
    )
      return false;
    if (field && o.field !== field) return false;
    if (country && o.country !== country) return false;
    return true;
  });

  if (filtered.length === 0) {
    grid.innerHTML =
      '<div class="no-res"><i class="fas fa-search"></i><p>No opportunities found. Try different filters.</p></div>';
    return;
  }

  grid.innerHTML = filtered
    .map(function (o) {
      var tm = typeMap[o.type] || { cls: "b-sch", fc: "fc-sch" };
      var dlCls = getDeadlineClass(o.deadline);
      var dlTxt = getDeadlineText(o.deadline);
      var isSaved = bookmarked.has(o.id);
      return (
        '<div class="opp-card fade-up visible">' +
        '<div class="opp-card-header"><span class="opp-type-badge ' +
        tm.cls +
        '">' +
        o.type +
        "</span>" +
        '<button class="bookmark-btn' +
        (isSaved ? " saved" : "") +
        '" data-id="' +
        o.id +
        '"><i class="fa' +
        (isSaved ? "s" : "r") +
        ' fa-bookmark"></i></button></div>' +
        "<h3>" +
        o.title +
        "</h3>" +
        '<div class="org"><i class="fas fa-university" style="margin-right:4px"></i>' +
        o.org +
        "</div>" +
        '<div class="desc">' +
        o.desc +
        "</div>" +
        '<div class="opp-meta">' +
        '<span><i class="fas fa-globe"></i> ' +
        o.country +
        "</span>" +
        '<span><i class="fas fa-flask"></i> ' +
        o.field +
        "</span>" +
        '<span><i class="fas fa-dollar-sign"></i> ' +
        o.amount +
        "</span>" +
        "</div>" +
        '<div class="opp-footer"><span class="dl-tag ' +
        dlCls +
        '">' +
        dlTxt +
        "</span>" +
        '<button class="apply-btn apply-btn-p" data-name="' +
        o.title +
        '">Apply Now</button></div></div>'
      );
    })
    .join("");

  // Bookmark click
  grid.querySelectorAll(".bookmark-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var id = parseInt(this.getAttribute("data-id"));
      if (bookmarked.has(id)) {
        bookmarked.delete(id);
        this.classList.remove("saved");
        this.innerHTML = '<i class="far fa-bookmark"></i>';
        showToast("Bookmark removed", "info");
      } else {
        bookmarked.add(id);
        this.classList.add("saved");
        this.innerHTML = '<i class="fas fa-bookmark"></i>';
        showToast("Opportunity bookmarked!", "success");
      }
    });
  });

  // Apply click
  grid.querySelectorAll(".apply-btn").forEach(function (btn) {
    btn.addEventListener("click", function () {
      showToast(
        'Application started for "' + this.getAttribute("data-name") + '"',
        "success",
      );
    });
  });
}

renderTabs();
renderOpportunities();

document
  .getElementById("searchIn")
  .addEventListener("input", renderOpportunities);
document
  .getElementById("fieldFil")
  .addEventListener("change", renderOpportunities);
document
  .getElementById("countryFil")
  .addEventListener("change", renderOpportunities);

// ===== HERO SEARCH =====
function heroSearchGo() {
  var val = document.getElementById("heroSearchIn").value;
  if (!val.trim()) {
    showToast("Please enter a search term", "error");
    return;
  }
  document.getElementById("searchIn").value = val;
  document
    .getElementById("opportunities")
    .scrollIntoView({ behavior: "smooth" });
  renderOpportunities();
}
document
  .getElementById("heroSearchBtn")
  .addEventListener("click", heroSearchGo);
document
  .getElementById("heroSearchIn")
  .addEventListener("keydown", function (e) {
    if (e.key === "Enter") heroSearchGo();
  });

// ===== ALERTS =====
(function renderAlerts() {
  var list = document.getElementById("alertsList");
  var sorted = OPPORTUNITIES.slice().sort(function (a, b) {
    return new Date(a.deadline) - new Date(b.deadline);
  });
  var upcoming = sorted.slice(0, 6);
  list.innerHTML = upcoming
    .map(function (o) {
      var days = Math.ceil((new Date(o.deadline) - new Date()) / 86400000);
      var cls = days <= 7 ? "urg" : days <= 21 ? "soon" : "norm";
      var txt = days <= 0 ? "Closed" : days === 1 ? "1 day" : days + " days";
      return (
        '<div class="alert-item"><div class="alert-dot ' +
        cls +
        '"></div>' +
        '<div class="alert-info"><h4>' +
        o.title +
        "</h4><p>" +
        o.org +
        " &middot; " +
        o.type +
        "</p></div>" +
        '<div class="alert-days ' +
        cls +
        '">' +
        txt +
        "</div></div>"
      );
    })
    .join("");
})();

// ===== ELIGIBILITY CHECKER =====
document.getElementById("eligBtn").addEventListener("click", function () {
  var deg = document.getElementById("eDeg").value;
  var cgpa = parseFloat(document.getElementById("eCgpa").value);
  var field = document.getElementById("eField").value;
  var country = document.getElementById("eCountry").value;
  var exp = parseInt(document.getElementById("eExp").value) || 0;

  if (!deg || isNaN(cgpa) || !field || !country) {
    showToast("Please fill all fields", "error");
    return;
  }

  var res = document.getElementById("eligRes");
  var score = 0;
  var tips = [];

  // Degree scoring
  var degScores = { hsc: 1, bachelor: 2, master: 3, phd: 4 };
  score += degScores[deg] || 0;

  // CGPA
  if (cgpa >= 3.5) {
    score += 3;
    tips.push("Excellent CGPA — qualifies for top scholarships");
  } else if (cgpa >= 3.0) {
    score += 2;
    tips.push("Good CGPA — eligible for most opportunities");
  } else if (cgpa >= 2.5) {
    score += 1;
    tips.push("Average CGPA — some opportunities available");
  } else {
    tips.push("Low CGPA — consider improving or target specific programs");
  }

  // Field
  var hotFields = ["Computer Science", "Engineering", "Medical Science"];
  if (hotFields.indexOf(field) !== -1) {
    score += 2;
    tips.push(field + " is a high-demand field");
  } else {
    score += 1;
    tips.push(field + " opportunities available but fewer");
  }

  // Country
  if (country === "Bangladesh" || country === "India" || country === "Nepal") {
    score += 1;
    tips.push("You qualify for developing-country specific scholarships");
  } else {
    score += 1;
  }

  // Experience
  if (exp >= 2) {
    score += 2;
    tips.push("Strong research background — great for fellowships");
  } else if (exp >= 1) {
    score += 1;
    tips.push("Some research experience — helpful for grants");
  } else {
    tips.push("Consider gaining research experience to boost eligibility");
  }

  var total = 12;
  var pct = Math.round((score / total) * 100);
  var cls = pct >= 70 ? "ok" : pct >= 40 ? "part" : "fail";
  var icon =
    pct >= 70
      ? "fa-check-circle"
      : pct >= 40
        ? "fa-exclamation-triangle"
        : "fa-times-circle";
  var label =
    pct >= 70
      ? "Highly Eligible"
      : pct >= 40
        ? "Partially Eligible"
        : "Low Eligibility";

  res.className = "elig-result show " + cls;
  res.innerHTML =
    '<div style="display:flex;align-items:center;gap:10px;margin-bottom:12px"><i class="fas ' +
    icon +
    '" style="font-size:24px"></i><strong style="font-size:18px">' +
    label +
    " — " +
    pct +
    "%</strong></div>" +
    '<ul style="padding-left:20px;line-height:2">' +
    tips
      .map(function (t) {
        return "<li>" + t + "</li>";
      })
      .join("") +
    "</ul>";
});

// ===== TRACKER =====
var stageOrder = ["applied", "review", "shortlisted", "accepted"];
var stageLabels = {
  applied: "Applied",
  review: "Under Review",
  shortlisted: "Shortlisted",
  accepted: "Accepted",
};
var stageClasses = {
  applied: "c-app",
  review: "c-rev",
  shortlisted: "c-sho",
  accepted: "c-acc",
};

function renderTracker() {
  var cols = document.getElementById("trackerCols");
  cols.innerHTML = stageOrder
    .map(function (stage) {
      var items = trackerData[stage];
      return (
        '<div class="tracker-col ' +
        stageClasses[stage] +
        '">' +
        '<div class="tc-head">' +
        stageLabels[stage] +
        ' <span class="cnt">' +
        items.length +
        "</span></div>" +
        items
          .map(function (item, idx) {
            return (
              '<div class="tracker-card" data-stage="' +
              stage +
              '" data-idx="' +
              idx +
              '"><h4>' +
              item.name +
              '</h4><div class="td">' +
              item.date +
              "</div></div>"
            );
          })
          .join("") +
        "</div>"
      );
    })
    .join("");

  cols.querySelectorAll(".tracker-card").forEach(function (card) {
    card.addEventListener("click", function () {
      var stage = this.getAttribute("data-stage");
      var idx = parseInt(this.getAttribute("data-idx"));
      var stageIdx = stageOrder.indexOf(stage);
      if (stageIdx < stageOrder.length - 1) {
        var item = trackerData[stage].splice(idx, 1)[0];
        trackerData[stageOrder[stageIdx + 1]].push(item);
        showToast(
          'Moved "' +
            item.name +
            '" to ' +
            stageLabels[stageOrder[stageIdx + 1]],
          "success",
        );
        renderTracker();
      } else {
        showToast(
          '"' + item.name + '" is already accepted! Congratulations!',
          "success",
        );
      }
    });
  });
}
renderTracker();

// ===== FACULTY POSTING =====
document.getElementById("postOppBtn").addEventListener("click", function () {
  var type = document.getElementById("fType").value;
  var org = document.getElementById("fOrg").value.trim();
  var title = document.getElementById("fTitle").value.trim();
  var field = document.getElementById("fField").value;
  var dead = document.getElementById("fDead").value;
  var amt = document.getElementById("fAmt").value.trim();
  var desc = document.getElementById("fDesc").value.trim();

  if (!type || !org || !title || !field || !dead || !amt || !desc) {
    showToast("Please fill all fields", "error");
    return;
  }

  OPPORTUNITIES.push({
    id: OPPORTUNITIES.length + 1,
    type: type,
    title: title,
    org: org,
    field: field,
    country: "Bangladesh",
    amount: amt,
    deadline: dead,
    desc: desc,
  });

  renderOpportunities();
  showToast("Opportunity posted successfully!", "success");

  // Clear form
  document.getElementById("fType").value = "";
  document.getElementById("fOrg").value = "";
  document.getElementById("fTitle").value = "";
  document.getElementById("fField").value = "";
  document.getElementById("fDead").value = "";
  document.getElementById("fAmt").value = "";
  document.getElementById("fDesc").value = "";
});

// ===== PROFILE MODAL =====
document.getElementById("profileBtn").addEventListener("click", function (e) {
  e.preventDefault();
  document.getElementById("profModal").classList.add("open");
});
document
  .getElementById("mobProfileBtn")
  .addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("profModal").classList.add("open");
    document.getElementById("mobMenu").classList.remove("open");
  });
document.getElementById("modalCloseBtn").addEventListener("click", function () {
  document.getElementById("profModal").classList.remove("open");
});
document.getElementById("profModal").addEventListener("click", function (e) {
  if (e.target === this) this.classList.remove("open");
});

document.getElementById("saveProfBtn").addEventListener("click", function () {
  var name = document.getElementById("pName").value.trim();
  var email = document.getElementById("pEmail").value.trim();
  if (!name || !email) {
    showToast("Please enter at least name and email", "error");
    return;
  }
  showToast("Profile saved for " + name + "!", "success");
  document.getElementById("profModal").classList.remove("open");
});

// ===== LIVE COUNTER =====
setInterval(function () {
  var el = document.getElementById("liveCount");
  var cur = parseInt(el.textContent);
  el.textContent = cur + Math.floor(Math.random() * 3);
}, 5000);

// ===== SCROLL REVEAL =====
var observer = new IntersectionObserver(
  function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible");
        // Trigger stats animation
        if (entry.target.id === "statsBar") animateStats();
      }
    });
  },
  { threshold: 0.15 },
);

document.querySelectorAll(".fade-up").forEach(function (el) {
  observer.observe(el);
});
