@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/yaml-cli
<<<<<<< HEAD
SET COMPOSER_RUNTIME_BIN_DIR=%~dp0
=======
SET COMPOSER_BIN_DIR=%~dp0
>>>>>>> origin/main
php "%BIN_TARGET%" %*
