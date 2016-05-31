# Test inserting recods
# options: b = use batch algorithm. t = use transaction
if [ -z $1 ]; then
    echo "no options passed"
fi;

time php test_inserting.php $1 && ./scripts/send_to_mysql.sh "truncate payment_methods;"
