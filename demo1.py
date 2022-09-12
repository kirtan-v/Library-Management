# cook your dish here
t= int(input())
while t:
    t-=1
    
    n,m= map(int, input().split())
    x,y= map(int, input().split())
    st=""
    
    while n>0:
        a,b=x,y
        str= input()
        for i in str:
            if i=="F":
                a-=1 
            if i=="P":
                b-=1  
        if a<=0 or (a==(x-1) and b<=0):
            st+="1"
        else:
            st+="0"
        n-=1
    print(st)


n= int(input())
b= []
temp=[]
count=0
a=[int(x) for x in range(1,n+1)]
c= a.copy()
flag=0
m= True
# print(a)
while n>0:
    n-=1
    b.append(int(input()))

if a==b:
    print("1")
else:
    for i in range(n):
        x=b[i]
        temp[x-1]=a[i]
    a.clear()
    a= temp.copy()
    temp.clear()
    count+=1
    print("a")
    while m==1:
        if a==c:
            m=0
            print("c")
            break
        else:
            for i in range(n):
                x=b[i]
                temp[x-1]=a[i]
            a.clear()
            a= temp.copy()
            temp.clear()
            count+=1
            print("b")
    else:
        print(count)
        
        
        

    
    


                
        