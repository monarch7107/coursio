# Coursio

Coursio is a curated directory of technology and business learning resources, with search, topic filters, and clear credential notes.

## Static site (permanent free hosting target)

The static version lives in `site/index.html` and runs entirely in the visitor's browser. It has no PHP runtime, Composer install, server-side routes, or database requirement.

### Deploy to GitHub Pages

1. In GitHub, open **Settings → Pages**.
2. Under **Build and deployment → Source**, choose **GitHub Actions**.
3. The workflow at `.github/workflows/deploy-pages.yml` publishes the `site/` directory whenever it changes on `main`.
4. Open **Actions** and wait for **Deploy Coursio static site to GitHub Pages** to succeed.
5. The project site URL will be `https://monarch7107.github.io/coursio/`.

GitHub Pages supports static files, not server-side PHP/Laravel. See the official docs: https://docs.github.com/en/pages/getting-started-with-github-pages/creating-a-github-pages-site

## Static version trade-offs

- Search, topic filtering, and credential filtering run in client-side JavaScript.
- The course list is embedded in `site/index.html`; edits require changing that file and committing.
- No user accounts, server-side validation, private admin area, database writes, or server-side APIs.
- Browser local storage could be used for per-device preferences, but would not sync between devices.

## Laravel version

The repository also retains the Laravel starter code and Dockerfile for server-hosted deployments. GitHub Pages publishes only the `site/` directory, not the Laravel app.
