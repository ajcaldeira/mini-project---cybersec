import boto3
import sys
def uploadToS3(FILE_NAME):
    s3_client = boto3.client('s3') 
    BUCKET = 'part4-1605007'
    
    s3_client.upload_file('../' + FILE_NAME,BUCKET,FILE_NAME,ExtraArgs={'ACL':'public-read'})

    bucket_location = s3_client.get_bucket_location(Bucket=BUCKET)
    object_url = f"https://s3-{bucket_location['LocationConstraint']}.amazonaws.com/{BUCKET}/{FILE_NAME}"
    print(object_url) 

def main():
    FILE_NAME = sys.argv[1]
    uploadToS3(FILE_NAME)


if __name__ == "__main__":
    main()
