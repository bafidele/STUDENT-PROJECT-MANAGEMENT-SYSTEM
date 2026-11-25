# Architecture

```
Browser
  │  HTTP request
  ▼
public/index.php  (front controller: error handler, headers, session, router)
  ▼
Controller   (src/Controllers)  reads input, checks CSRF, decides what happens
  ▼
Service      (src/Services)     validates and normalises data
  ▼
Model        (src/Models)       runs prepared SQL through PDO
  ▼
Database     (MySQL: students, supervisors, categories, projects)
  ▲
View         (src/Views)        turns the data into HTML, escaped with View::e()
  │  HTTP response
  ▼
Browser
```

Each layer talks only to its neighbour: views hold no SQL, models hold no HTML, controllers only coordinate. The JSON controllers in `src/Controllers/Api` reuse the same services and models, so the web pages and the API can never disagree about the rules.
