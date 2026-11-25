# Extra certificates for the Docker build

Put a `.crt` file (PEM format) here when an antivirus or company proxy inspects HTTPS,
for example Avast "Web/Mail Shield". Without it, `npm ci` and `composer install` inside
the build fail with "unable to get local issuer certificate".

These files are only used by the build steps that download packages. They are never copied
into the final image, and `*.crt` files here are kept out of git.
