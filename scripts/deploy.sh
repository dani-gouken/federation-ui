export -p > .env
gcloud storage rsync public gs://${GCLOUD_BUCKET} --recursive --delete-unmatched-destination-objects