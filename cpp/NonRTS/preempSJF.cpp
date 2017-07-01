#include<bits/stdc++.h>
#define INF_MAX 99999
using namespace std;
struct process
{
    int pno,arrival,execution,remainingtime,temparrival;
    bool flag;
};
struct startend
{
    char clock[2000];
    int k;
    int start;
    int end;
};
int cmpfunc(const void *a_, const void *b_)
{
    process *a = (process *)a_;
     process *b = (process *)b_;
    if (a->temparrival < b->temparrival) return -1;
    if (a->temparrival > b->temparrival) return 1;
    if (a->remainingtime < b->remainingtime) return -1;
    if (a->remainingtime > b->remainingtime) return 1;
    return 0;
}
int main(int arg,char* argv[])
{
    char *filename;
    if(arg>1)
    {
        filename = argv[1];
        //cout<<filename;
    }
    else{
        cout<<"No Input";
        exit(1);
    }

    fstream file;

    file.open(filename,ios::in | ios::out);

    int n;
    file>>n;
    struct process p[n+1];
    struct startend st[n+1];
    for(int i=0;i<n;i++)
    {
        p[i].pno = i+1;
        file>>p[i].arrival;
        file>>p[i].execution;
        p[i].temparrival=p[i].arrival;
        p[i].remainingtime=p[i].execution;
        st[p[i].pno].k=0;
    }
    st[n].k=0;
    int flag=0;
    int clock=0;
    qsort(p,n,sizeof(process),cmpfunc);
    /*for(int i=0;i<n;i++)
        cout<<p[i].pno<<" "<<p[i].arrival<<endl;*/
        for(int i=0;i<=n;i++)
        {
            for(int j=0;j<=2000;j++)
            {
                st[i].clock[j]='_';
            }
        }
    while(flag<n)
    {
        if(p[0].arrival<=clock)
        {
            p[0].remainingtime--;
            if(clock==p[0].arrival)
                {
                    st[p[0].pno].clock[clock]='#';
                }
                else
                {
                    st[p[0].pno].clock[clock]='*';
                    if(st[p[0].pno].clock[p[0].arrival]!='#')
                    st[p[0].pno].clock[p[0].arrival]='|';
                }
            if(p[0].flag==false)
            {
                st[p[0].pno].start=clock;
                p[0].flag=true;
            }
            if(p[0].remainingtime==0)
            {
                flag++;
                st[p[0].pno].end=clock;
                p[0].temparrival=INF_MAX;
            }
        }
        clock++;
        for(int i=0;i<n;i++)
        {
            if(p[i].temparrival<=clock && p[i].temparrival!=INF_MAX)
            p[i].temparrival=0;
        }
        qsort(p,n,sizeof(process),cmpfunc);
    }
    //cout<<endl;
    /*for(int i=1;i<=n;i++)
    {
        cout<<i<<" "<<st[i].start<<" "<<++st[i].end<<endl;
    }
    cout<<endl;*/
    for(int i=1;i<=n;i++)
    {
        for(int j=0;j<=clock+1;j++)
            cout<<st[i].clock[j];
            cout<<endl;
    }
    int response[n+1];
    for(int i=0;i<n;i++)
    {
        response[p[i].pno]=st[p[i].pno].end+1-p[i].arrival;
        //cout<<p[i].pno<<" "<<st[p[i].pno].end<<endl;
    }
    for(int i=1;i<=n;i++)
    {
        cout<<"Response time for Task "<<i<<" = "<<response[i]<<endl;
    }
    return 0;
}
