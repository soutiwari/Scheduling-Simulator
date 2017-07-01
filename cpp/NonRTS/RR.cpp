#include<bits/stdc++.h>
#include<fstream>
using namespace std;
struct process{
    int start[2000];
    int end[2000];
    int k;
    char clock[2000];
};
int main(int arg, char* argv[])
{
    char *filename;
    if(arg>1)
    {
        filename = argv[1];
        //cout<<filename;
    }
    else{
        cout<<"no input";
        exit(1);
    }

    fstream file;

    file.open(filename,ios::in | ios::out);


  int i,j,n,time,remain,flag=0,ts;
  int sum_wait=0,sum_turnaround=0;
  //printf("Enter no of Processes : ");
  //scanf("%d",&n);
    file>>n;
    file>>ts;
  remain=n;
  int at[n],bt[n],rt[n];
  //int clock[2000];
  struct process p[n];
  for(int i=0;i<n;i++)
  {
    p[i].k=0;
  }
  for(i=0;i<n;i++)
  {
    //printf("Enter arrival time and burst time for Process P%d :",i+1);
    //scanf("%d",&at[i]);
    file>>at[i];
    //scanf("%d",&bt[i]);
    file>>bt[i];
    rt[i]=bt[i];
  }
  //printf("Enter time slice");
  //scanf("%d",&ts);

  for(time=0,i=0;remain!=0;)
  {
    if(rt[i]<=ts && rt[i]>0)
    {
    p[i].start[p[i].k]=time;
    //cout<<i+1<<"  time-start-"<<time<<" ";
      time+=rt[i];
      rt[i]=0;
      flag=1;
        //cout<<"time-end-"<<time<<endl;
      p[i].end[p[i].k]=time;
      p[i].k++;
    }
    else if(rt[i]>0)
    {
    //cout<<i+1<<"  time-start-"<<time<<" ";
      p[i].start[p[i].k]=time;
      rt[i]-=ts;
      time+=ts;
      //cout<<"time-end-"<<time<<endl;
      p[i].end[p[i].k]=time;
      p[i].k++;
    }
    if(rt[i]==0 && flag==1)
    {
      remain--;
      flag=0;
    }
    if(i==n-1)
      i=0;
    else if(at[i+1]<=time)
      i++;
    else
    {
        for(int j=0;j<=i;j++)
        {
            if(rt[j]!=0)
            i=j;
            else
            time=at[i+1];
        }
    }
  }
   for(int i=0;i<n;i++)
  {
    for(int j=0;j<=time;j++)
    {
        p[i].clock[j]='_';
    }
  }
  for(int i=0;i<n;i++)
  {
        for(int j=0;j<p[i].k;j++)
        {
            //cout<<i<<" "<<p[i].k<<endl;
            for(int l=p[i].start[j];l<p[i].end[j];l++)
                {
                    //cout<<p[i].start[l]<<" "<<p[i].end[l]<<endl;
                    p[i].clock[l]='*';
                }
        }
  }
  for(int i=0;i<n;i++)
  {
    for(int j=0;j<=time;j++)
        {
            if(j==at[i] && p[i].clock[j]=='*')
            p[i].clock[j]='#';
        else if(j==at[i])
            p[i].clock[j]='|';
            cout<<p[i].clock[j];
        }
    cout<<endl;
  }
  int response[n];
  for(int i=0;i<n;i++)
  {
        response[i]=p[i].end[p[i].k-1]-at[i];
  }
  for(int i=0;i<n;i++)
  {
        cout<<"Response time for Task "<<(i+1)<<" = "<<response[i]<<endl;
  }
  return 0;
}


