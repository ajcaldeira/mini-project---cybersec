import boto3
import sys
import json
def readFromDB(EMAIL):
    dynamodb = boto3.resource('dynamodb')
    table = dynamodb.Table('users')

    response = table.get_item(
    Key={
            'id': EMAIL
        }
    )
    item = response['Item']
    #password = item['password']
    print(str(item).replace("'", '"')) #convert it to a string and then replace single quoted with doubles for php

def main():
    EMAIL = sys.argv[1]
    readFromDB(EMAIL)


if __name__ == "__main__":
    main()
