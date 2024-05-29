export -p > .env
gcloud storage buckets update gs://${GCLOUD_BUCKET} --cors-file=gcloud-cors.json