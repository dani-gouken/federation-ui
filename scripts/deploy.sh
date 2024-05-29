export -p > .env
gcloud storage rsync public gs://federation-assets --recursive --delete-unmatched-destination-objects