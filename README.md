# Atelier 1 – Analysis and Refactoring of a University Application

---

## 📌 Context  

You are provided with a **web application** for academic management, developed in **native PHP** (no classes or objects).  

The current application allows:  
- Student registration to modules  
- Viewing grades  
- Managing timetables  
- Internal messaging between users  

The university now wants to extend the system by adding:  
- An **online exam module**  
- A **platform for pedagogical videos**  
- A **mobile interface** giving access to main features via **API**  

---

## 📝 Tasks  

### Step 1 — Analysis of the Existing System  
1. Examine the provided source code (see installation guide to run the project).  
2. Identify the **programming paradigm** used.  
3. Discuss strengths and weaknesses of this approach (readability, maintainability, security, scalability).  
4. Describe the **logical architecture** (code organization, modules, main flows).  
5. Describe the **physical architecture** (deployment structure, components).  

### Step 2 — Critical Study  
6. List design issues found in the current application.  
7. Explain why this architecture struggles to meet the new requirements.  

### Step 3 — Proposal for Evolution  
8. Propose a **new programming paradigm** better adapted to the system’s evolution (**justify your choice**).  
9. Define a new **logical and physical architecture**, with clear module/service separation and support for mobile + new features.  
10. Provide an **architecture diagram** of your proposal.  

---

## 📦 Deliverables  

Each team (3–4 students) must provide:  

1. A **report (4–6 pages)** including:  
   - Current architecture (logical + physical)  
   - Identified limitations and problems  
   - Proposed new architecture (logical + physical)  
   - Recommended programming paradigm and technologies (with advantages)  

2. An **UML diagram** (or equivalent) illustrating your proposal.  
3. A **short oral presentation** (5–10 minutes per team).  

---

## 🚀 Getting Started with the Code  

1. Clone the repository:  
   ```bash
   git clone <repo-url>
   cd atelier-1-soa
   ```  

2. Set up a local **PHP environment** (e.g., XAMPP, WAMP, or PHP built-in server).  

3. Import the database if provided (see `/db` folder or installation guide).  

4. Run the project locally:  
   ```bash
   php -S localhost:8000
   ```  
   Then open [http://localhost:8000](http://localhost:8000) in your browser.  

---

## 🎯 Learning Goals  

By completing this workshop, students will:  
- Practice analyzing existing code and identifying **design flaws**.  
- Understand the **limitations of procedural programming** for large systems.  
- Explore **refactoring strategies** towards service-oriented architectures.  
- Gain experience in defining **logical and physical architectures**.  
- Learn to justify a **programming paradigm shift** (e.g., from procedural to OOP, MVC, or service-based).  
